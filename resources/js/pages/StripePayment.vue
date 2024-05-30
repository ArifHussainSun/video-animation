<template>
    <div class="container padd-30-on-mob">
        <div class="row">
            <pageSidebar :service="service"></pageSidebar>
            <mainForm :countries="countries"></mainForm>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="threeDSecure-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"  data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="threeDIframe_Body"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import pageSidebar from '../components/stripe/pageSidebar.vue'
    import mainForm from '../components/stripe/mainForm.vue'

    export default {
        name: 'StripePayment',
        components: { pageSidebar, mainForm },

        data() {
            return {
                service: '',
                countries: ''
            };
        },

        mounted() {
            console.log(process.env.MIX_APP_URL);
            this.getTokenDetail().then(paymentLink => {
                this.service = paymentLink.data.service;
            });

            this.getCountries().then(countries => {
                this.countries = countries.data;
            });
        },

        methods: {
            async getTokenDetail() {
                const token = this.getQueryParam('token');
                
                return await axios.get(route('payment.fetch.token', {_query: {token: token}}))
                .then(response => {
                    if(response.status == 200) {
                        return response.data;
                    } else {
                        throw new Error("API error");
                    }
                }).then(data => {
                    return data;
                })
                .catch(function (response) {
                    //handle error
                    console.log(response);
                    return false;
                });
            },

            async getCountries() {
                const token = this.getQueryParam('token');
                
                return await axios.get(route('api.fetch.countries'))
                .then(response => {
                    if(response.status == 200) {
                        return response.data;
                    } else {
                        throw new Error("API error");
                    }
                }).then(data => {
                    return data;
                })
                .catch(function (response) {
                    //handle error
                    console.log(response);
                    return false;
                });
            },
            
            getQueryParam(key) {
                const searchParams = new URLSearchParams(window.location.search);
                return searchParams.get(key);
            }
        }
    }
</script>