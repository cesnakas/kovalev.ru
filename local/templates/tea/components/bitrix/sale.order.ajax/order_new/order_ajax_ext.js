(function () {
    'use strict';

    var initParent = BX.Sale.OrderAjaxComponent.init,
        getBlockFooterParent = BX.Sale.OrderAjaxComponent.getBlockFooter,
        editOrderParent = BX.Sale.OrderAjaxComponent.editOrder
    ;

    BX.namespace('BX.Sale.OrderAjaxComponentExt');

    BX.Sale.OrderAjaxComponentExt = BX.Sale.OrderAjaxComponent;

    BX.Sale.OrderAjaxComponentExt.init = function (parameters) {
        initParent.apply(this, arguments);

        var editSteps = this.orderBlockNode.querySelectorAll('.bx-soa-editstep'), i;
        for (i in editSteps) {
            if (editSteps.hasOwnProperty(i)) {
                BX.remove(editSteps[i]);
            }
        }
        
        var ndCoup = this.totalBlockNode.querySelector('.order__item-content');
        this.editCoupons(ndCoup);
        // console.log('this.result', this.result);

    };

    /**
     * Binds main events for scrolling/resizing
     */
    /*BX.Sale.OrderAjaxComponentExt.bindEvents = function () {
        BX.bind(this.orderSaveBlockNode.querySelector('[data-save-button]'), 'click', BX.proxy(this.clickOrderSaveAction, this));
        // BX.bind(window, 'scroll', BX.proxy(this.totalBlockScrollCheck, this));
        BX.bind(window, 'resize', BX.throttle(function () {
            this.totalBlockResizeCheck();
            this.alignBasketColumns();
            this.basketBlockScrollCheck();
            this.mapsReady && this.resizeMapContainers();
        }, 50, this));
        BX.addCustomEvent('onDeliveryExtraServiceValueChange', BX.proxy(this.sendRequest, this));
    }*/

    //отключение кнопок "назад/вперёд"
    BX.Sale.OrderAjaxComponentExt.getBlockFooter = function (node) {
        var parentNodeSection = BX.findParent(node, {className: 'order__item'});

        // getBlockFooterParent.apply(this, arguments);
        var sections = this.orderBlockNode.querySelectorAll('.order__item.bx-active'),
            firstSection = sections[0],
            lastSection = sections[sections.length - 1],
            currentSection = BX.findParent(node, {className: "order__item"}),
            isLastNode = false,
            buttons = [];

        if (currentSection && currentSection.id.indexOf(firstSection.id) == '-1') {
            buttons.push(
                BX.create('button', {
                    props: {
                        href: 'javascript:void(0)',
                        className: 'btn btn-outline-secondary pl-3 pr-3'
                    },
                    html: this.params.MESS_BACK,
                    events: {
                        click: BX.proxy(this.clickPrevAction, this)
                    }
                })
            );
        }

        if (currentSection && currentSection.id.indexOf(lastSection.id) != '-1')
            isLastNode = true;

        if (!isLastNode) {
            buttons.push(
                BX.create('button', {
                    props: {href: 'javascript:void(0)', className: 'pull-right btn btn-primary pl-3 pr-3'},
                    html: this.params.MESS_FURTHER,
                    events: {click: BX.proxy(this.clickNextAction, this)}
                })
            );
        }
        

        
        //отключение доп. полей ввода купона
        if (!(/bx-soa-basket/.test(parentNodeSection.id))) {
            BX.remove(parentNodeSection.querySelector('.bx-soa-coupon'));
            BX.remove(parentNodeSection.querySelector('.bx-soa-more'));
        }

    };

    BX.Sale.OrderAjaxComponentExt.editOrder = function (section) {
        editOrderParent.apply(this, arguments);

        var sections = this.orderBlockNode.querySelectorAll('.order__item'), i;
        for (i in sections) {
            if (sections.hasOwnProperty(i)) {
                if (!(/bx-soa-auth|bx-soa-properties|bx-soa-basket/.test(sections[i].id))) {
                    // sections[i].classList.add('order__item-hide');
                }
            }
        }

    };

    BX.Sale.OrderAjaxComponentExt.locationsCompletion = function () {

    }

    BX.Sale.OrderAjaxComponentExt.initFirstSection = function (parameters) {
        var i, locationNode, clearButton, inputStep, inputSearch,
            arProperty, data, section;
        
        return true;

        this.locationsInitialized = true;
        this.fixLocationsStyle(this.regionBlockNode, this.regionHiddenBlockNode);
        this.fixLocationsStyle(this.propsBlockNode, this.propsHiddenBlockNode);

        for (i in this.locations) {
            if (!this.locations.hasOwnProperty(i))
                continue;

            locationNode = this.orderBlockNode.querySelector('div[data-property-id-row="' + i + '"]');
            if (!locationNode)
                continue;

            clearButton = locationNode.querySelector('div.bx-ui-sls-clear');
            inputStep = locationNode.querySelector('div.bx-ui-slst-pool');
            inputSearch = locationNode.querySelector('input.bx-ui-sls-fake[type=text]');

            locationNode.removeAttribute('style');
            this.bindValidation(i, locationNode);
            if (clearButton) {
                BX.bind(clearButton, 'click', function (e) {
                    var target = e.target || e.srcElement,
                        parent = BX.findParent(target, {tagName: 'DIV', className: 'form-group'}),
                        locationInput;

                    if (parent)
                        locationInput = parent.querySelector('input.bx-ui-sls-fake[type=text]');

                    if (locationInput)
                        BX.fireEvent(locationInput, 'keyup');
                });
            }

            if (!this.firstLoad && this.options.propertyValidation) {
                if (inputStep) {
                    arProperty = this.validation.properties[i];
                    data = this.getValidationData(arProperty, locationNode);
                    section = BX.findParent(locationNode, {className: 'order__item'});

                    if (section && section.getAttribute('data-visited') == 'true')
                        this.isValidProperty(data);
                }

                if (inputSearch)
                    BX.fireEvent(inputSearch, 'keyup');
            }
        }

        if (this.firstLoad && this.result.IS_AUTHORIZED && typeof this.result.LAST_ORDER_DATA.FAIL === 'undefined') {
            this.showActualBlock();
        } else if (!this.result.SHOW_AUTH) {
            this.changeVisibleContent();
        }
        this.changeVisibleContent();
        this.checkNotifications();
    };

    BX.Sale.OrderAjaxComponentExt.editSection = function (section) {
        if (!section || !section.id)
            return;

        if (this.result.SHOW_AUTH && section.id != this.authBlockNode.id && section.id != this.basketBlockNode.id) {
            section.style.display = 'none';
        } else if (section.id != this.pickUpBlockNode.id) {
            section.style.display = '';
        }

        var active = true,
            titleNode = section.querySelector('.order__item-title-container'),
            editButton, errorContainer;

        errorContainer = section.querySelector('.alert.alert-danger');
        this.hasErrorSection[section.id] = errorContainer && errorContainer.style.display != 'none';

        switch (section.id) {
            case this.authBlockNode.id:
                this.editAuthBlock();
                break;
            case this.basketBlockNode.id:
                this.editBasketBlock(active);
                break;
            case this.regionBlockNode.id:
                this.editRegionBlock(active);
                break;
            case this.paySystemBlockNode.id:
                this.editPaySystemBlock(active);
                break;
            case this.deliveryBlockNode.id:
                this.editDeliveryBlock(active);
                break;
            case this.pickUpBlockNode.id:
                this.editPickUpBlock(active);
                break;
            case this.propsBlockNode.id:
                this.editPropsBlock(active);
                break;
        }

        section.setAttribute('data-visited', 'true');
    };

    BX.Sale.OrderAjaxComponentExt.getDeliveryLocationInput = function (node) {
        var currentProperty, locationId, altId, location, k, altProperty,
            labelHtml, currentLocation, insertedLoc,
            labelTextHtml, label, input, altNode;

        for (k in this.result.ORDER_PROP.properties) {
            if (this.result.ORDER_PROP.properties.hasOwnProperty(k)) {
                currentProperty = this.result.ORDER_PROP.properties[k];
                if (currentProperty.IS_LOCATION == 'Y') {
                    locationId = currentProperty.ID;
                    altId = parseInt(currentProperty.INPUT_FIELD_LOCATION);
                    break;
                }
            }
        }

        location = this.locations[locationId];
        if (location && location[0] && location[0].output) {
            this.regionBlockNotEmpty = true;

            labelHtml = '<label class="bx-soa-custom-label" for="soa-property-' + parseInt(locationId) + '">'
                + (currentProperty.REQUIRED == 'Y' ? '<span class="bx-authform-starrequired">*</span> ' : '')
                + BX.util.htmlspecialchars(currentProperty.NAME)
                + (currentProperty.DESCRIPTION.length ? ' <small>(' + BX.util.htmlspecialchars(currentProperty.DESCRIPTION) + ')</small>' : '')
                + '</label>';

            currentLocation = location[0].output;
            insertedLoc = BX.create('DIV', {
                attrs: {'data-property-id-row': locationId},
                props: {className: 'form-group bx-soa-location-input-container'},
                // style: {visibility: 'hidden'},
                html: labelHtml + currentLocation.HTML
            });
            node.appendChild(insertedLoc);
            node.appendChild(BX.create('INPUT', {
                props: {
                    type: 'hidden',
                    name: 'RECENT_DELIVERY_VALUE',
                    value: location[0].lastValue
                }
            }));

            for (k in currentLocation.SCRIPT)
                if (currentLocation.SCRIPT.hasOwnProperty(k))
                    BX.evalGlobal(currentLocation.SCRIPT[k].JS);
        }

        if (location && location[0] && location[0].showAlt && altId > 0) {
            for (k in this.result.ORDER_PROP.properties) {
                if (parseInt(this.result.ORDER_PROP.properties[k].ID) == altId) {
                    altProperty = this.result.ORDER_PROP.properties[k];
                    break;
                }
            }
        }

        if (altProperty) {
            altNode = BX.create('DIV', {
                attrs: {'data-property-id-row': altProperty.ID},
                props: {className: "form-group bx-soa-location-input-container"}
            });

            labelTextHtml = altProperty.REQUIRED == 'Y' ? '<span class="bx-authform-starrequired">*</span> ' : '';
            labelTextHtml += BX.util.htmlspecialchars(altProperty.NAME);

            label = BX.create('LABEL', {
                attrs: {for: 'altProperty'},
                props: {className: 'bx-soa-custom-label'},
                html: labelTextHtml
            });

            input = BX.create('INPUT', {
                props: {
                    id: 'altProperty',
                    type: 'text',
                    placeholder: altProperty.DESCRIPTION,
                    autocomplete: 'city',
                    className: 'form-control bx-soa-customer-input bx-ios-fix',
                    name: 'ORDER_PROP_' + altProperty.ID,
                    value: altProperty.VALUE
                }
            });

            altNode.appendChild(label);
            altNode.appendChild(input);
            node.appendChild(altNode);

            this.bindValidation(altProperty.ID, altNode);
        }

        this.getZipLocationInput(node);

        /*   if (location && location[0]) {
               node.appendChild(
                   BX.create('DIV', {
                       props: {className: 'bx-soa-reference'},
                       html: this.params.MESS_REGION_REFERENCE
                   })
               );
           }*/
    }

    BX.Sale.OrderAjaxComponentExt.editActivePropsBlock = function (activeNodeMode) {
        var node = activeNodeMode ? this.propsBlockNode : this.propsHiddenBlockNode,
            propsContent, propsNode, selectedDelivery, showPropMap = false, i, validationErrors;

        if (this.initialized.props) {
            BX.remove(BX.lastChild(node));
            node.appendChild(BX.firstChild(this.propsHiddenBlockNode));
            this.maps && setTimeout(BX.proxy(this.maps.propsMapFocusWaiter, this.maps), 200);
        } else {
            propsContent = node.querySelector('.order__item-content');
            if (!propsContent) {
                propsContent = this.getNewContainer();
                node.appendChild(propsContent);
            } else
                BX.cleanNode(propsContent);

            this.getErrorContainer(propsContent);

            // propsNode = BX.create('DIV', {props: {className: 'row'}});
            selectedDelivery = this.getSelectedDelivery();

            if (
                selectedDelivery && this.params.SHOW_MAP_IN_PROPS === 'Y'
                && this.params.SHOW_MAP_FOR_DELIVERIES && this.params.SHOW_MAP_FOR_DELIVERIES.length
            ) {
                for (i = 0; i < this.params.SHOW_MAP_FOR_DELIVERIES.length; i++) {
                    if (parseInt(selectedDelivery.ID) === parseInt(this.params.SHOW_MAP_FOR_DELIVERIES[i])) {
                        showPropMap = true;
                        break;
                    }
                }
            }

            this.editPropsItems(propsContent, null, [1, 2, 3, 4]);
            showPropMap && this.editPropsMap(propsContent);

            // if (this.params.HIDE_ORDER_DESCRIPTION !== 'Y') {
            //     this.editPropsComment(propsContent);
            // }

            // propsContent.appendChild(propsNode);
            this.getBlockFooter(propsContent);

            if (this.propsBlockNode.getAttribute('data-visited') === 'true') {
                validationErrors = this.isValidPropertiesBlock(true);
                if (validationErrors.length)
                    BX.addClass(this.propsBlockNode, 'bx-step-error');
                else
                    BX.removeClass(this.propsBlockNode, 'bx-step-error');
            }
        }
    }
    BX.Sale.OrderAjaxComponentExt.editPropsItems = function (propsNode, pIdsInc = null, pIdsExc = null) {
        if (!this.result.ORDER_PROP || !this.propertyCollection)
            return;

        var propsItemsContainer = BX.create('DIV', {props: {className: 'order-wrap__row row bx-soa-customer'}}),
            group, property, groupIterator = this.propertyCollection.getGroupIterator(), propsIterator;
        var propSettings;
        var propOrders = [];

        if (!propsItemsContainer)
            propsItemsContainer = this.propsBlockNode.querySelector('.bx-soa-customer');
        
        while (group = groupIterator()) {
            propsIterator = group.getIterator();
            propOrders = [];
            
            while (property = propsIterator()) {
                let pId = Number(property.getId());

                if (pIdsInc != null && $.inArray(pId, pIdsInc) < 0
                ) {
                    continue;
                }
                if (pIdsExc != null && $.inArray(pId, pIdsExc) >= 0
                ) {
                    continue;
                }

                if (
                    this.deliveryLocationInfo.loc == property.getId()
                    || this.deliveryLocationInfo.zip == property.getId()
                    || this.deliveryLocationInfo.city == property.getId()
                )
                    continue;

                this.getPropertyRowNode(property, propsItemsContainer, false);
            }

        }
        propsNode.insertBefore(propsItemsContainer, propsNode.firstChild);

        //propsNode.appendChild(propsItemsContainer);
    }
    BX.Sale.OrderAjaxComponentExt.getPropertyRowNode = function (property, propsItemsContainer, disabled) {
        var propsItemNode = BX.create('DIV'),
            textHtml = '',
            propertyType = property.getType() || '',
            propertyDesc = property.getDescription() || '';

        if (disabled) {
            propsItemNode.innerHTML = '<strong>' + BX.util.htmlspecialchars(property.getName()) + ':</strong> ';
        } else {
            BX.addClass(propsItemNode, "bx-soa-customer-field");

            if (property.isRequired())
                textHtml += '<span class="bx-authform-starrequired">*</span> ';

            textHtml += BX.util.htmlspecialchars(property.getName());
            if (propertyDesc.length && propertyType != 'STRING' && propertyType != 'NUMBER' && propertyType != 'DATE')
                textHtml += ' <small>(' + BX.util.htmlspecialchars(propertyDesc) + ')</small>';

            // label = BX.create('LABEL', {
            //     attrs: {'for': 'soa-property-' + property.getId()},
            //     props: {className: 'bx-soa-custom-label'},
            //     html: textHtml
            // });
            propsItemNode.setAttribute('data-property-id-row', property.getId());

            if (property.getId() == 6 || property.getId() == 7 || property.getId() == 8 || property.getId() == 9 || property.getId() == 10 || property.getId() == 11) {
                BX.addClass(propsItemNode, 'order-wrap__col col-4 col-md-4');
            } else {
                BX.addClass(propsItemNode, 'order-wrap__col col-12');
            }

            // propsItemNode.appendChild(label);
        }

        switch (propertyType) {
            case 'LOCATION':
                this.insertLocationProperty(property, propsItemNode, disabled);
                break;
            case 'DATE':
                this.insertDateProperty(property, propsItemNode, disabled);
                break;
            case 'FILE':
                this.insertFileProperty(property, propsItemNode, disabled);
                break;
            case 'STRING':
                this.insertStringProperty(property, propsItemNode, disabled);
                break;
            case 'ENUM':
                this.insertEnumProperty(property, propsItemNode, disabled);
                break;
            case 'Y/N':
                this.insertYNProperty(property, propsItemNode, disabled);
                break;
            case 'NUMBER':
                this.insertNumberProperty(property, propsItemNode, disabled);
        }

        propsItemsContainer.appendChild(propsItemNode);
    }

    //Delivery
    BX.Sale.OrderAjaxComponentExt.createDeliveryItem = function (item) {
        var checked = item.CHECKED == 'Y',
            deliveryId = parseInt(item.ID),
            labelNodes = [],
            deliveryCached = this.deliveryCachedInfo[deliveryId],
            label, title, price, itemNode, itemDesc, itemNodeWrap;
        
        //console.log(item);
        
        var inputNode = BX.create('INPUT', {
            props: {
                id: 'ID_DELIVERY_ID_' + deliveryId,
                name: 'DELIVERY_ID',
                type: 'checkbox',
                className: 'bx-soa-pp-company-checkbox radio-card__input',
                value: deliveryId,
                checked: checked
            }
        });
        
        console.log(item);
        
        var childDesc = item.DESCRIPTION + ' ' + item.PERIOD_TEXT;

        title = BX.create('DIV', {
            props: {className: 'radio-item__caption'},
           // text: this.params.SHOW_DELIVERY_PARENT_NAMES != 'N' ? item.NAME : item.OWN_NAME
            children: [BX.create('DIV', {
                        props: {className: 'radio-item__name'},
                        html: this.params.SHOW_DELIVERY_PARENT_NAMES != 'N' ? item.NAME : item.OWN_NAME
                    }),
                       
                    BX.create('DIV', {
                        props: {className: 'radio-item__text'},
                        html: childDesc
                    })
            ]
        });
        
        if (item.PRICE >= 0 || typeof item.DELIVERY_DISCOUNT_PRICE !== 'undefined') {
            
            price = BX.create('DIV', {
                props: {className: 'radio-item__price'},
                html: typeof item.DELIVERY_DISCOUNT_PRICE !== 'undefined'
                        ? '<span class="price">' + item.DELIVERY_DISCOUNT_PRICE_FORMATED + '</span>'
                        : '<span class="price">' + item.PRICE_FORMATED + '</span>'
            }); 
            /*labelNodes.push(
                BX.create('DIV', {
                    props: {className: 'bx-soa-pp-delivery-cost radio-card__price'},
                    html: typeof item.DELIVERY_DISCOUNT_PRICE !== 'undefined'
                        ? item.DELIVERY_DISCOUNT_PRICE_FORMATED
                        : item.PRICE_FORMATED
                })
            );*/
        } else if (deliveryCached && (deliveryCached.PRICE >= 0 || typeof deliveryCached.DELIVERY_DISCOUNT_PRICE !== 'undefined')) {
            // labelNodes.push(
            //     BX.create('DIV', {
            //         props: {className: 'bx-soa-pp-delivery-cost radio-card__price'},
            //         html: typeof deliveryCached.DELIVERY_DISCOUNT_PRICE !== 'undefined'
            //             ? deliveryCached.DELIVERY_DISCOUNT_PRICE_FORMATED
            //             : deliveryCached.PRICE_FORMATED
            //     })
            // );
        }
        

        
        
        

        /*labelNodes.push(BX.create('DIV', {
                props: {className: 'radio-card__content'},
                children: [title, price]
            })
        );*/
        
       /*
        if (item.PRICE >= 0 || typeof item.DELIVERY_DISCOUNT_PRICE !== 'undefined') {
            labelNodes.push(
                BX.create('DIV', {
                    props: {className: 'bx-soa-pp-delivery-cost radio-card__price'},
                    html: typeof item.DELIVERY_DISCOUNT_PRICE !== 'undefined'
                        ? item.DELIVERY_DISCOUNT_PRICE_FORMATED
                        : item.PRICE_FORMATED
                })
            );
        } else if (deliveryCached && (deliveryCached.PRICE >= 0 || typeof deliveryCached.DELIVERY_DISCOUNT_PRICE !== 'undefined')) {
            // labelNodes.push(
            //     BX.create('DIV', {
            //         props: {className: 'bx-soa-pp-delivery-cost radio-card__price'},
            //         html: typeof deliveryCached.DELIVERY_DISCOUNT_PRICE !== 'undefined'
            //             ? deliveryCached.DELIVERY_DISCOUNT_PRICE_FORMATED
            //             : deliveryCached.PRICE_FORMATED
            //     })
            // );
        }*/


        label = BX.create('label', {
            attrs: {
                for: 'ID_DELIVERY_ID_' + deliveryId,
            },
            props: {
                className: 'radio-card__label'
                    + (item.CALCULATE_ERRORS || deliveryCached && deliveryCached.CALCULATE_ERRORS ? ' bx-bd-waring' : '')
            },
            children: [title, price]
        });


        itemNode = BX.create('DIV', {
            props: {className: 'bx-soa-pp-company radio-card'},
            children: [inputNode, label, itemDesc],
            events: {click: BX.proxy(this.selectDelivery, this)}
        });
        checked && BX.addClass(itemNode, 'bx-selected');

        if (checked && this.result.LAST_ORDER_DATA.PICK_UP)
            this.lastSelectedDelivery = deliveryId;

        return itemNode;
    }

    BX.Sale.OrderAjaxComponentExt.editDeliveryItems = function (deliveryNode) {
        if (!this.result.DELIVERY || this.result.DELIVERY.length <= 0)
            return;

        var deliveryItemsContainer = BX.create('DIV', {props: {className: 'radio-wrap bx-soa-pp-item-container'}}),
            // deliveryItemsContainerRow = BX.create('DIV', {props: {className: 'radio-wrap__item'}}),
            deliveryItemNode, k;

        for (k = 0; k < this.deliveryPagination.currentPage.length; k++) {
            deliveryItemNode = this.createDeliveryItem(this.deliveryPagination.currentPage[k]);
            deliveryItemsContainer.appendChild(deliveryItemNode);
        }
        // deliveryItemsContainer.appendChild(deliveryItemsContainerRow);

        if (this.deliveryPagination.show)
            this.showPagination('delivery', deliveryItemsContainer);

        deliveryNode.appendChild(deliveryItemsContainer);
    }

    BX.Sale.OrderAjaxComponentExt.editDeliveryInfo = function (deliveryNode) {
        if (!this.result.DELIVERY)
            return;

        var deliveryInfoContainer = BX.create('DIV', {props: {className: 'bx-soa-pp-desc-container radio-card__more-info'}}),
            currentDelivery, logotype, name, logoNode,
            subTitle, label, title, price, period,
            clear, infoList, extraServices, extraServicesNode;

        BX.cleanNode(deliveryInfoContainer);
        currentDelivery = this.getSelectedDelivery();

        var deliveryCheckbox = this.deliveryBlockNode.querySelector('input[type=checkbox][name=DELIVERY_ID]:checked'),
            deliveryCheckboxWrap;
        if (!deliveryCheckbox)
            deliveryCheckbox = this.deliveryHiddenBlockNode.querySelector('input[type=hidden][name=DELIVERY_ID]');

        deliveryCheckboxWrap = BX.findParent(deliveryCheckbox, {class: 'radio-card'});

        name = this.params.SHOW_DELIVERY_PARENT_NAMES != 'N' ? currentDelivery.NAME : currentDelivery.OWN_NAME;

        // if (this.params.SHOW_DELIVERY_INFO_NAME == 'Y')
        //     subTitle = BX.create('DIV', {props: {className: 'bx-soa-pp-company-subTitle'}, text: name});

        title = BX.create('DIV', {
            props: {className: 'bx-soa-pp-company-block'},
            children: [
                BX.create('DIV', {props: {className: 'bx-soa-pp-company-desc'}, html: currentDelivery.DESCRIPTION}),
                currentDelivery.CALCULATE_DESCRIPTION
                    ? BX.create('DIV', {
                        props: {className: 'bx-soa-pp-company-desc'},
                        html: currentDelivery.CALCULATE_DESCRIPTION
                    })
                    : null
            ]
        });

        if (currentDelivery.PRICE >= 0)
        {
            price = BX.create('LI', {
                children: [
                    BX.create('DIV', {
                        props: {className: 'bx-soa-pp-list-termin'},
                        html: this.params.MESS_PRICE + ':'
                    }),
                    BX.create('DIV', {
                        props: {className: 'bx-soa-pp-list-description'},
                        children: this.getDeliveryPriceNodes(currentDelivery)
                    })
                ]
            });
        }

        if (currentDelivery.PERIOD_TEXT && currentDelivery.PERIOD_TEXT.length)
        {
            period = BX.create('LI', {
                children: [
                    BX.create('DIV', {props: {className: 'bx-soa-pp-list-termin'}, html: this.params.MESS_PERIOD + ':'}),
                    BX.create('DIV', {props: {className: 'bx-soa-pp-list-description'}, html: currentDelivery.PERIOD_TEXT})
                ]
            });
        }

        clear = BX.create('DIV', {style: {clear: 'both'}});
        infoList = BX.create('UL', {props: {className: 'bx-soa-pp-list'}, children: [price, period]});
        extraServices = this.getDeliveryExtraServices(currentDelivery);

        if (extraServices.length) {
            extraServicesNode = BX.create('DIV', {
                props: {className: 'bx-soa-pp-company-block'},
                children: extraServices
            });
        }

        deliveryInfoContainer.appendChild(
            BX.create('DIV', {
                props: {className: 'bx-soa-pp-company'},
                children: [subTitle, label, title, clear, extraServicesNode, infoList]
            })
        );
        // deliveryNode.appendChild(deliveryInfoContainer);
        deliveryCheckboxWrap.appendChild(deliveryInfoContainer);

        if (this.params.DELIVERY_NO_AJAX != 'Y')
            this.deliveryCachedInfo[currentDelivery.ID] = currentDelivery;
    }

    BX.Sale.OrderAjaxComponentExt.editActiveDeliveryBlock = function (activeNodeMode) {
        var node = activeNodeMode ? this.deliveryBlockNode : this.deliveryHiddenBlockNode,
            deliveryContent, deliveryNode;

        if (this.initialized.delivery) {
            BX.remove(BX.lastChild(node));
            node.appendChild(BX.firstChild(this.deliveryHiddenBlockNode));
        } else {
            deliveryContent = node.querySelector('.order__item-content');
            if (!deliveryContent) {
                deliveryContent = this.getNewContainer();
                node.appendChild(deliveryContent);
            } else
                BX.cleanNode(deliveryContent);

            this.getErrorContainer(deliveryContent);

            deliveryNode = BX.create('DIV', {props: {className: 'bx-soa-pp'}});
            this.editDeliveryItems(deliveryNode);
            deliveryContent.appendChild(deliveryNode);
            //this.editDeliveryInfo(deliveryNode);

            if (this.params.SHOW_COUPONS_DELIVERY == 'Y')
                this.editCoupons(deliveryContent);

            this.getBlockFooter(deliveryContent);
        }
    }

    //Payment
    BX.Sale.OrderAjaxComponentExt.editActivePaySystemBlock = function (activeNodeMode) {
        var node = activeNodeMode ? this.paySystemBlockNode : this.paySystemHiddenBlockNode,
            paySystemContent, paySystemNode;

        if (this.initialized.paySystem) {
            // BX.remove(BX.lastChild(node));
            // node.appendChild(BX.firstChild(this.paySystemHiddenBlockNode));
        } else {
            paySystemContent = node.querySelector('.order__item-content');
            if (!paySystemContent) {
                paySystemContent = this.getNewContainer();
                node.appendChild(paySystemContent);
            } else
                BX.cleanNode(paySystemContent);

            this.getErrorContainer(paySystemContent);
            paySystemNode = BX.create('DIV', {props: {className: 'bx-soa-pp'}});
            this.editPaySystemItems(paySystemNode);
            paySystemContent.appendChild(paySystemNode);
            // this.editPaySystemInfo(paySystemNode);

            if (this.params.SHOW_COUPONS_PAY_SYSTEM == 'Y')
                this.editCoupons(paySystemContent);

            this.getBlockFooter(paySystemContent);
        }
    }

    BX.Sale.OrderAjaxComponentExt.editPaySystemItems = function (paySystemNode) {
        if (!this.result.PAY_SYSTEM || this.result.PAY_SYSTEM.length <= 0)
            return;

        var paySystemItemsContainer = BX.create('DIV', {props: {className: 'radio-wrap bx-soa-pp-item-container'}}),
            // paySystemItemsContainerRow = BX.create('DIV', {props: {className: 'row'}}),
            paySystemItemNode, i;

        for (i = 0; i < this.paySystemPagination.currentPage.length; i++) {
            paySystemItemNode = this.createPaySystemItem(this.paySystemPagination.currentPage[i]);
            paySystemItemsContainer.appendChild(paySystemItemNode);
        }
        // paySystemItemsContainer.appendChild(paySystemItemsContainerRow);

        if (this.paySystemPagination.show)
            this.showPagination('paySystem', paySystemItemsContainer);

        paySystemNode.appendChild(paySystemItemsContainer);
    }

    BX.Sale.OrderAjaxComponentExt.createPaySystemItem = function (item) {
        var checked = item.CHECKED == 'Y',
            logotype, logoNode,
            paySystemId = parseInt(item.ID),
            title, label, itemNode;

        var inputNode = BX.create('INPUT', {
            props: {
                id: 'ID_PAY_SYSTEM_ID_' + paySystemId,
                name: 'PAY_SYSTEM_ID',
                type: 'checkbox',
                className: 'bx-soa-pp-company-checkbox radio-card__input',
                value: paySystemId,
                checked: checked
            }
        })

        if (this.params.SHOW_PAY_SYSTEM_LIST_NAMES == 'Y') {
            title = BX.create('DIV', {
                props: {className: 'bx-soa-pp-company-smalltitle radio-card__title'},
                text: item.NAME
            });
        }

        var cardContentNode = BX.create('DIV', {
            props: {className: 'radio-card__content'},
            children: [title]
        });

        label = BX.create('label', {
            attrs: {
                for: 'ID_PAY_SYSTEM_ID_' + paySystemId,
            },
            props: {className: 'radio-card__label'},
            children: [logoNode, cardContentNode]
        });

        itemNode = BX.create('DIV', {
            props: {className: 'bx-soa-pp-company radio-card'},
            children: [inputNode, label],
            events: {
                click: BX.proxy(this.selectPaySystem, this)
            }
        });

        if (checked)
            BX.addClass(itemNode, 'bx-selected');

        return itemNode;
    }

    BX.Sale.OrderAjaxComponentExt.editPaySystemInfo = function (paySystemNode) {
        if (!this.result.PAY_SYSTEM || (this.result.PAY_SYSTEM.length == 0 && this.result.PAY_FROM_ACCOUNT != 'Y'))
            return;

        var paySystemInfoContainer = BX.create('DIV', {
                props: {
                    className: 'bx-soa-pp-desc-container'
                }
            }),
            innerPs, extPs, delimiter, currentPaySystem,
            logotype, logoNode, subTitle, label, title, price;

        BX.cleanNode(paySystemInfoContainer);

        if (this.result.PAY_FROM_ACCOUNT == 'Y')
            innerPs = this.getInnerPaySystem(paySystemInfoContainer);

        currentPaySystem = this.getSelectedPaySystem();
        if (currentPaySystem) {
            logoNode = BX.create('DIV', {props: {className: 'bx-soa-pp-company-image'}});
            logotype = this.getImageSources(currentPaySystem, 'PSA_LOGOTIP');
            if (logotype && logotype.src_2x) {
                logoNode.setAttribute('style',
                    'background-image: url("' + logotype.src_1x + '");' +
                    'background-image: -webkit-image-set(url("' + logotype.src_1x + '") 1x, url("' + logotype.src_2x + '") 2x)'
                );
            } else {
                logotype = logotype && logotype.src_1x || this.defaultPaySystemLogo;
                logoNode.setAttribute('style', 'background-image: url("' + logotype + '");');
            }

            if (this.params.SHOW_PAY_SYSTEM_INFO_NAME == 'Y') {
                subTitle = BX.create('DIV', {
                    props: {className: 'bx-soa-pp-company-subTitle'},
                    text: currentPaySystem.NAME
                });
            }

            label = BX.create('DIV', {
                props: {className: 'bx-soa-pp-company-logo'},
                children: [
                    BX.create('DIV', {
                        props: {className: 'bx-soa-pp-company-graf-container'},
                        children: [logoNode]
                    })
                ]
            });

            title = BX.create('DIV', {
                props: {className: 'bx-soa-pp-company-block'},
                children: [BX.create('DIV', {
                    props: {className: 'bx-soa-pp-company-desc'},
                    html: currentPaySystem.DESCRIPTION
                })]
            });

            if (currentPaySystem.PRICE && parseFloat(currentPaySystem.PRICE) > 0) {
                price = BX.create('UL', {
                    props: {className: 'bx-soa-pp-list'},
                    children: [
                        BX.create('LI', {
                            children: [
                                BX.create('DIV', {
                                    props: {className: 'bx-soa-pp-list-termin'},
                                    html: this.params.MESS_PRICE + ':'
                                }),
                                BX.create('DIV', {
                                    props: {className: 'bx-soa-pp-list-description'},
                                    text: '~' + currentPaySystem.PRICE_FORMATTED
                                })
                            ]
                        })
                    ]
                });
            }

            extPs = BX.create('DIV', {children: [subTitle, label, title, price]});
        }

        if (innerPs && extPs)
            delimiter = BX.create('HR', {props: {className: 'bxe-light'}});

        paySystemInfoContainer.appendChild(
            BX.create('DIV', {
                props: {className: 'bx-soa-pp-company'},
                children: [innerPs, delimiter, extPs]
            })
        );
        paySystemNode.appendChild(paySystemInfoContainer);
    }


    //Basket
    BX.Sale.OrderAjaxComponentExt.editActiveBasketBlock = function (activeNodeMode) {
        var node = !!activeNodeMode ? this.basketBlockNode : this.basketHiddenBlockNode,
            basketContent, basketTable;

        if (this.initialized.basket) {
            // this.basketHiddenBlockNode.appendChild(BX.lastChild(node));
            node.appendChild(BX.firstChild(this.basketHiddenBlockNode));
        } else {
            basketContent = node.querySelector('.order__item-content');
            basketTable = BX.create('DIV', {props: {className: 'bx-soa-item-table order-wrap__list'}});

            if (!basketContent) {
                basketContent = this.getNewContainer(true);
                node.appendChild(basketContent);
            } else {
                BX.cleanNode(basketContent);
            }

            this.editBasketItems(basketTable, true);

            basketContent.appendChild(
                BX.create('DIV', {
                    props: {className: 'bx-soa-table-fade'},
                    children: [basketTable]
                })
            );
            
            if (this.params.SHOW_COUPONS_BASKET === 'Y') {
                /*var nodeCoup = BX.findChild(BX('bx-soa-total'), {'class': 'order__item-content'}, true);
                this.editCoupons(nodeCoup);*/

                this.editCoupons(basketContent);
            }

            this.getBlockFooter(basketContent);

            // BX.bind(
            //     basketContent.querySelector('div.bx-soa-table-fade').firstChild,
            //     'scroll',
            //     BX.proxy(this.basketBlockScrollCheckEvent, this)
            // );
        }
        console.log('test');
        this.alignBasketColumns();
    }

    BX.Sale.OrderAjaxComponentExt.editBasketItems = function (basketItemsNode, active) {
        if (!this.result.GRID.ROWS)
            return;

        var index = 0, i;

        if (this.params.SHOW_BASKET_HEADERS === 'Y') {
            this.editBasketItemsHeader(basketItemsNode);
        }

        for (i in this.result.GRID.ROWS) {
            if (this.result.GRID.ROWS.hasOwnProperty(i)) {
                this.createBasketItem(basketItemsNode, this.result.GRID.ROWS[i], index++, !!active);
            }
        }

        this.basketBlockNode.querySelector('[data-entity="section-title"] .order-wrap__number').innerHTML = Object.keys(this.result.GRID.ROWS).length;

    }

    BX.Sale.OrderAjaxComponentExt.createBasketItem = function (basketItemsNode, item, index, active) {
        var
            mainColumnsImage = [],
            mainColumns = [],
            otherColumns = [],
            hiddenColumns = [],
            currentColumn, basketColumnIndex = 0,
            i, tr, cols;

        if (this.options.showPreviewPicInBasket || this.options.showDetailPicInBasket) {
            mainColumnsImage.push(this.createBasketItemImg(item.data));
        }

        mainColumns.push(BX.create('a', {
            props: {className: 'product-card__delete'},
            attrs: {
                'href': 'javascript:void(0);',
                // 'onclick': 'bx_basketFKauiI.removeItemFromCart(' + item.id + ');',
            },
            html: '<span class="icon-clarity_trash-line"></span>'
        }));

        mainColumns.push(this.createBasketItemContent(item.data));

        for (i = 0; i < this.result.GRID.HEADERS.length; i++) {
            currentColumn = this.result.GRID.HEADERS[i];

            if (currentColumn.id === 'NAME' || currentColumn.id === 'PREVIEW_PICTURE' || currentColumn.id === 'PROPS' || currentColumn.id === 'NOTES')
                continue;

            if (currentColumn.id === 'DETAIL_PICTURE' && !this.options.showPreviewPicInBasket)
                continue;

            otherColumns.push(this.createBasketItemColumn(currentColumn, item, active));

            ++basketColumnIndex;
            if (basketColumnIndex == 4 && this.result.GRID.HEADERS[i + 1]) {
                otherColumns.push(BX.create('DIV', {props: {className: 'bx-soa-item-nth-4p1'}}));
                basketColumnIndex = 0;
            }
        }

        if (active) {
            for (i = 0; i < this.result.GRID.HEADERS_HIDDEN.length; i++) {
                tr = this.createBasketItemHiddenColumn(this.result.GRID.HEADERS_HIDDEN[i], item);
                if (BX.type.isArray(tr))
                    hiddenColumns = hiddenColumns.concat(tr);
                else if (tr)
                    hiddenColumns.push(tr);
            }
        }

        cols = mainColumnsImage;

        cols = cols.concat(mainColumns);

        // cols = cols.concat(otherColumns);

        basketItemsNode.appendChild(
            BX.create('DIV', {
                props: {className: 'product-card bx-soa-item-tr bx-soa-basket-info' + (index == 0 ? ' bx-soa-item-tr-first' : '')},
                attrs: {'data-property-id-row': item.id},
                children: cols
            })
        );

        if (hiddenColumns.length) {
            basketItemsNode.appendChild(
                BX.create('DIV', {
                    props: {className: 'bx-soa-item-tr bx-soa-item-info-container'},
                    children: [
                        BX.create('DIV', {
                            props: {className: 'bx-soa-item-td'},
                            children: [
                                /*BX.create('A', {
                                    props: {href: '', className: 'bx-soa-info-shower'},
                                    html: this.params.MESS_ADDITIONAL_PROPS,
                                    events: {
                                        click: BX.proxy(this.showAdditionalProperties, this)
                                    }
                                }),*/
                                BX.create('DIV', {
                                    props: {className: 'bx-soa-item-info-block'},
                                    children: [
                                        BX.create('TABLE', {
                                            props: {className: 'bx-soa-info-block'},
                                            children: hiddenColumns
                                        })
                                    ]
                                })
                            ]
                        })
                    ]
                })
            );
        }
    }

    BX.Sale.OrderAjaxComponentExt.createBasketItemImg = function (data) {
        if (!data)
            return;

        var logoNode, logotype, logoNodePicture;

        logoNode = BX.create('img');

        if (data.PREVIEW_PICTURE_SRC && data.PREVIEW_PICTURE_SRC.length)
            logotype = this.getImageSources(data, 'PREVIEW_PICTURE');
        else if (data.DETAIL_PICTURE_SRC && data.DETAIL_PICTURE_SRC.length)
            logotype = this.getImageSources(data, 'DETAIL_PICTURE');

        if (logotype && logotype.src_2x) {
            logoNode.setAttribute('src',
                logotype.src_2x
            );
        } else {
            logotype = logotype && logotype.src_1x || this.defaultBasketItemLogo;
            logoNode.setAttribute('src',
                logotype.src_1x
            );
        }

        return BX.create('DIV', {
            props: {className: 'bx-soa-item-img-block product-card__img'},
            children: [BX.create(
                'picture',
                {
                    children: [logoNode]
                }
            )]
        });
    }

    BX.Sale.OrderAjaxComponentExt.createBasketItemContent = function (data) {
        var itemName = data.NAME || '',
            titleHtml = this.htmlspecialcharsEx(itemName),
            props = data.PROPS || [],
            propsNodes = [];

        if (this.params.HIDE_DETAIL_PAGE_URL !== 'Y' && data.DETAIL_PAGE_URL && data.DETAIL_PAGE_URL.length) {
            titleHtml = '<a href="' + data.DETAIL_PAGE_URL + '">' + titleHtml + '</a>';
        }

        if (this.options.showPropsInBasket && props.length) {
            for (var i in props) {
                if (props.hasOwnProperty(i)) {
                    var name = props[i].NAME || '',
                        value = props[i].VALUE || '';

                    propsNodes.push(
                        BX.create('DIV', {
                            props: {className: 'product-card__info-label'},
                            text: value
                        })
                    );
                }
            }
        }

        var propsNodesAr = [];
        propsNodesAr.push(BX.create('DIV', {props: {className: 'product-card__name'}, html: titleHtml}));
        if (propsNodes.length) {
            propsNodesAr.push(BX.create('DIV', {
                props: {className: 'bx-scu-container product-card__detail-info'},
                children: propsNodes
            }));
        }

        //quantity
        /*propsNodesAr.push(BX.create('DIV', {
            props: {className: 'counter js-counter'},
            html: '<span class="counter__minus js-counter-action" data-counter="-1"></span>\n' +
                '<input type="text" name="counter" value="' + data.QUANTITY + '" class="counter__input">\n' +
                '<span class="counter__plus js-counter-action" data-counter="1"></span>'
        }));*/

        //cost
        var costNode = BX.create('DIV', {
            props: {className: 'product-card__price-wrap'},
        });

        //price base
        costNode.append(BX.create('span', {
            props: {className: 'price-normal'},
            html: data.PRICE_FORMATED
        }));

        if (data.BASE_PRICE != data.PRICE) {
            //price old
            costNode.append(BX.create('span', {
                props: {className: 'price-old'},
                html: data.BASE_PRICE_FORMATED
            }));
        }


        propsNodesAr.push(costNode);


        return BX.create('DIV', {
            props: {className: 'product-card__content'},
            children: propsNodesAr
        });
    }


    //totals
    BX.Sale.OrderAjaxComponentExt.editTotalBlock = function () {
        if (!this.totalInfoBlockNode || !this.result.TOTAL)
            return;

        var total = this.result.TOTAL,
            priceHtml, params = {},
            discText, valFormatted, i,
            curDelivery, deliveryError, deliveryValue,
            showOrderButton = this.params.SHOW_TOTAL_ORDER_BUTTON === 'Y';
        
        BX.cleanNode(this.totalInfoBlockNode);

        /*if (parseFloat(total.ORDER_PRICE) === 0) {
            priceHtml = this.params.MESS_PRICE_FREE;
            params.free = true;
        } else {
            priceHtml = total.ORDER_PRICE_FORMATED;
        }

        if (this.options.showPriceWithoutDiscount) {
            priceHtml += '<br><span class="bx-price-old">' + total.PRICE_WITHOUT_DISCOUNT + '</span>';
        }

        this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_SUMMARY'), priceHtml, params));*/

        if (this.options.showOrderWeight) {
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_WEIGHT_SUM'), total.ORDER_WEIGHT_FORMATED));
        }

        if (this.options.showTaxList) {
            for (i = 0; i < total.TAX_LIST.length; i++) {
                valFormatted = total.TAX_LIST[i].VALUE_MONEY_FORMATED || '';
                this.totalInfoBlockNode.appendChild(
                    this.createTotalUnit(
                        total.TAX_LIST[i].NAME + (!!total.TAX_LIST[i].VALUE_FORMATED ? ' ' + total.TAX_LIST[i].VALUE_FORMATED : '') + ':',
                        valFormatted
                    )
                );
            }
        }

        params = {};
        curDelivery = this.getSelectedDelivery();
        deliveryError = curDelivery && curDelivery.CALCULATE_ERRORS && curDelivery.CALCULATE_ERRORS.length;

        if (deliveryError) {
            deliveryValue = BX.message('SOA_NOT_CALCULATED');
            params.error = deliveryError;
        } else {
            if (parseFloat(total.DELIVERY_PRICE) === 0) {
                deliveryValue = this.params.MESS_PRICE_FREE;
                params.free = true;
            } else {
                deliveryValue = total.DELIVERY_PRICE_FORMATED;
            }

            if (
                curDelivery && typeof curDelivery.DELIVERY_DISCOUNT_PRICE !== 'undefined'
                && parseFloat(curDelivery.PRICE) > parseFloat(curDelivery.DELIVERY_DISCOUNT_PRICE)
            ) {
                deliveryValue += '<br><span class="bx-price-old">' + curDelivery.PRICE_FORMATED + '</span>';
            }
        }

        if (this.result.DELIVERY.length) {
            params.style = '__delivery';
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_DELIVERY'), deliveryValue, params));
        }

        if (this.options.showDiscountPrice) {
            discText = this.params.MESS_ECONOMY;
            if (total.DISCOUNT_PERCENT_FORMATED && parseFloat(total.DISCOUNT_PERCENT_FORMATED) > 0)
                discText += total.DISCOUNT_PERCENT_FORMATED;

            this.totalInfoBlockNode.appendChild(this.createTotalUnit(discText + ':', total.DISCOUNT_PRICE_FORMATED, {style: '__sale'}));
        }

        if (this.options.showPayedFromInnerBudget) {
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_IT'), total.ORDER_TOTAL_PRICE_FORMATED));
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_PAYED'), total.PAYED_FROM_ACCOUNT_FORMATED));
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_LEFT_TO_PAY'), total.ORDER_TOTAL_LEFT_TO_PAY_FORMATED, {total: true}));
        } else {
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_SUM_IT'), total.ORDER_TOTAL_PRICE_FORMATED, {style: '__total'}));
        }

        if (parseFloat(total.PAY_SYSTEM_PRICE) >= 0 && this.result.DELIVERY.length) {
            this.totalInfoBlockNode.appendChild(this.createTotalUnit(BX.message('SOA_PAYSYSTEM_PRICE'), '~' + total.PAY_SYSTEM_PRICE_FORMATTED));
        }

        if (!this.result.SHOW_AUTH) {
           /* this.totalInfoBlockNode.appendChild(
                BX.create('DIV', {
                    props: {className: 'bx-soa-cart-total-button-container' + (!showOrderButton ? ' d-block d-sm-none' : '')},
                    children: [
                        BX.create('A', {
                            props: {
                                href: 'javascript:void(0)',
                                className: 'btn btn-primary btn-lg btn-order-save'
                            },
                            html: this.params.MESS_ORDER,
                            events: {
                                click: BX.proxy(this.clickOrderSaveAction, this)
                            }
                        })

                    ]
                })
            );*/
            
            var btn = BX.findChild(BX('order_form_content'), {'class': 'js-btn-order-save'}, true);
            BX.bind(btn, 'click', BX.proxy(this.clickOrderSaveAction, this));

        }


        this.editMobileTotalBlock();
    }

    BX.Sale.OrderAjaxComponentExt.createTotalUnit = function (name, value, params) {
        var totalValue, className = 'order-wrap__total-row';

        name = name || '';
        value = value || '';
        params = params || {};

        if (params.error) {
            totalValue = [BX.create('A', {
                props: {className: 'bx-soa-price-not-calc'},
                html: value,
                events: {
                    click: BX.delegate(function () {
                        this.animateScrollTo(this.deliveryBlockNode);
                    }, this)
                }
            })];
        } else if (params.free) {
            totalValue = [BX.create('SPAN', {
                props: {className: 'bx-soa-price-free'},
                html: value
            })];
        } else {
            totalValue = [value];
        }

        if (params.style) {
            className += ' order__price' + params.style;
        }

        return BX.create('DIV', {
            props: {className: className},
            children: [
                BX.create('SPAN', {props: {className: 'order__label'}, text: name}),
                BX.create('SPAN', {
                    props: {
                        className: 'price' + (!!params.total && this.options.totalPriceChanged ? ' bx-soa-changeCostSign' : '')
                    },
                    children: totalValue
                })
            ]
        });
    }

})();

