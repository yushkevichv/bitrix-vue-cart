<template>
    <div class="container">
        <div id="basket_form_container">
            <div class="bx_ordercart bx_green">
                <div class="bx_sort_container">
                    <span>Товары в корзине:</span>
                </div>
                <div v-if="products">
                    <div id="basket_items_list">
                        <div class="bx_ordercart_order_table_container">
                            <div id="basket_items">
                                <div class="row">
                                    <div class="col-md-4">
                                        Товары
                                    </div>
                                    <div class="col-md-2">
                                        Цена
                                    </div>
                                    <div class="col-md-2">
                                        Количество
                                    </div>
                                    <div class="col-md-2">
                                        Сумма
                                    </div>
                                    <div class="col-md-2"></div>


                                </div>
                                <div v-for="product in products">
                                    <basket-product :product="product" @updateQuantity="updateQuantity(product.ID, product.QUANTITY)"></basket-product>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    В корзине нет товаров
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
//            console.log('Component mounted.')
        },
        props: {
            products: {
                type: Array,
                required: false
            },
            sessid: {
                type: [String, Number],
                required: false
            }
        },
        methods: {
//            updateQuantity(product_id, quantity)  {
//                console.log('here');
//                console.log('product ' + product_id);
//                console.log('count ' + quantity);
//
//                let data = {
//                    sessid: this.sessid,
//                    'site_id': BX.message('SITE_ID'),
//                    action_var: 'basketAction',
//                    basketAction: 'recalculate',
//                }
//
//                data['QUANTITY_'+product_id] = quantity;
//
//                axios.post("/bitrix/components/bitrix/sale.basket.basket/ajax.php",
//                    data
//                ).then(response => {
//                    this.products = response.data.products;
//                this.price = response.data.price;
//            }).
//                catch(error => console.error(error)
//            )
//                ;
//
//
//            }
        },
        components: {
            "basket-product": require("./BasketProduct.vue")
        }

    }
</script>
