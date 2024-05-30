<template>
    <div class="col-md-8 order-md-1" id="main-formarea">
        <h4 class="justify-content-between align-items-center mb-3 section-heading">
            <span class="badge badge-secondary display-desktop">1</span>
            <span class="badge badge-secondary display-mobile">2</span>
            <span>Billing Information</span>
        </h4>

        <form id="payment-form" class="needs-validation" action="{{ route('payment.stripe.process') }}" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" id="firstName" name="firstname" placeholder="First Name" data-parsley-required="true" required>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" id="lastName" name="lastname" placeholder=" Last Name " data-parsley-required="true" required>
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="email" class="form-control" id="email" name="clientemail" placeholder="Email Address" data-parsley-type="email" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <input type="tel" id="phone" name="phonenum" class="form-control" data-parsley-type="digits" style="width:100%;padding-right: 56px;">
                        </div>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                    <span id="valid-msg" class="hide"></span>
                    <span id="error-msg" class="hide"></span>
                </div>
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                <div class="invalid-feedback">
                    Please enter your address.
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <input type="text" class="form-control" id="companyName" name="companyname" placeholder="Company Name" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                <div class="col-lg-6 mb-3">


                    <select class="custom-select d-block w-100" name="country" id="country" required>
                        <option selected disabled>Select Country</option>
                        <option v-for="country in countries" :key="country.id" value="{{ country.id }}" data-countryCode="{{ country.alpha_code2 }}">{{ country.country_name }}</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid country.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 col-md-6 mb-3">
                    <input type="text" class="form-control" name="statename" minlength="4" id="statename" placeholder="State" required>

                    <div class="invalid-feedback">
                        Please provide a valid state.
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-3">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <input type="number" class="form-control" name="zipcode" minlength="4" min="0" id="zip" placeholder="Zip Code" required>
                    <div class="invalid-feedback">
                        Zip code required.
                    </div>
                </div>
            </div>

            <h4 class="justify-content-between align-items-center mb-3 mt-3 section-heading">
                <span class="badge badge-secondary display-desktop">2</span>
                <span class="badge badge-secondary display-mobile">3</span>
                <span>Payment Information</span>
            </h4>

            <div class="row">
                <div class="col-md-12" id="bt-dropin">
                    <div class="form-row">
                        <label for="card-element"></label>

                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                            <CardElement></CardElement>
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                </div>
                
                <div class="col-lg-7 col-md-12">
                    <input type="text" class="form-control" name="cardNo" maxlength="19" id="cardNo" placeholder="Card Number" required>

                    <div class="invalid-feedback">
                        Please provide a card number.
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 d-flex">
                    <div class="col-lg-4 col-md-4">
                        <input type="text" maxlength="2" class="form-control" id="expiry_month" name="expiry_month" placeholder="MM" required>
                        <div class="invalid-feedback">
                            Expiry Month is required.
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <input type="text" maxlength="4" class="form-control" id="expiry_year" name="expiry_year" placeholder="YYYY" required>
                        <div class="invalid-feedback">
                            Expiry Year is required.
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <input type="text" maxlength="4" class="form-control" id="cvc" name="cvc" placeholder="CVC" required>
                        <div class="invalid-feedback">
                            CVC is required.
                        </div>
                    </div>
                </div>
                
                <div class="card-errors"></div>
            </div>
            
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" id="card-button" data-secret="<?php //echo $intent->client_secret; ?>" type="submit">Pay Now</button>
        </form>
    </div>
</template>

<script>
    import CardElement from './CardElement.vue'
    export default {
        components: {CardElement},

        props: {
            countries: { 
                type: Array, 
                default() {
                    return [];
                } 
            },
        },
        data() {
            countries: ''
        }
    }
</script>