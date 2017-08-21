<template>
    <div class="container">
        <div id="basket_form_container">
            <div class="bx_ordercart bx_green">
                <div class="bx_sort_container">
                    <span>Товары в корзине:</span>
                </div>
                <basket-items></basket-items>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
//            console.log('Component mounted.')
        },
    components: {
        "basket-items": require("./BasketItems.vue")
    }

    }
</script>
