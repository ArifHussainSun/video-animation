<template>
    <div class="col-md-4 order-md-2 mb-4" id="sidebar">
        <h4 class="justify-content-between align-items-center mb-3 section-heading">
            <span class="badge badge-secondary display-desktop">3</span>
            <span class="badge badge-secondary display-mobile">1</span>
            <span>Billing Invoice</span>
        </h4>
        <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h5 class="my-0">{{ service.item_name }}</h5>
                </div>

            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">Item Price</h6>
                </div>
                <span class="text-muted itemprice_coupon" id="itemPrice">{{ service.item_name }} {{ service.original_amount }}</span>
            </li>

            <li class="list-group-item d-flex justify-content-between bg-light" id="discount_div" v-show="service.discounted_amount !== null">
                <div class="text-success">
                    <h6 class="my-0">Discount</h6>
                    <small></small>
                </div>
                <span class="text-success" id="itemDiscount">{{ countryCode }} {{ service.discounted_amount }}</span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <span>Total ({{ countryCode }})</span>
                <strong id="calculated_total" class="total_amount">{{ countryCode }} {{ service.price }}</strong>
            </li>
        </ul>

        <div id="coupon-div">
            <div class="input-group">
            <input type="text" class="form-control coupon-code" placeholder="Promo code">
            <div class="input-group-append">
                <button type="button" id="" class="btn btn-secondary apply-coupon">Redeem</button>
            </div>
            </div>
            
            <div class="coupon-response-div"></div>
            
        </div>

        <div class="complete">
            <a href="javascript::void(0)" target="_blank" class="money-back-img" style="display:table;margin:12px auto;clear:both">
                <img :src="appUrl('frontend/payment/images/moneyback.png')" width="200">
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            service: {
                type: Object,
                default() {
                    return {};
                },
            },
        },

        data() {
            service: ''
        },

        methods: {
            appUrl(path) {
                return process.env.MIX_APP_URL + path;
            }
        },

        computed: {
            countryCode() {
                return this.service.countrycurrencies?.currency_code;
            }
        }
    }
</script>