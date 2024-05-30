<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    <style>
        body, table, thead, tbody, tr, td, img { padding: 0; margin: 0; border: none; border-spacing: 0px; border-collapse: collapse; vertical-align: top; font-family: 'Helvetica', 'Arial', sans-serif; font-size: 14px; color: #9c9c9c; }
        .background { background-color: #4A2880; }
        .white-background { background-color: #ffffff; }
        .background p { font-weight: 500; margin: 0; line-height: 1.5; }
        .header-padding { padding: 30px 20px; color: #ffffff; }
        .header-padding p { text-align: right; }
        .header-padding a { color: #ffffff; text-decoration: none; }
        .logo { width: 100%; max-width: 150px; }
        .customer-sec-padding { padding: 30px 20px; }
        .customer-padding h1 { font-size: 12px; color: #9c9c9c; margin-top: 0; }
        .customer-padding p { font-weight: 600; margin: 0; line-height: 1.5; color: #000000; }
        .customer-padding h2 { color: #4A2880; margin-top: 0; font-size: 34px; }
        .client-heading { padding: 10px 20px; }
        .client-heading p { color: #ffffff; font-size: 16px; }
        .client-detail { padding: 14px 20px; font-weight: 600; color: #666666; }
        .client-detail a { color: #666666; text-decoration: none; }
        .dark { background: #f0f0f0; }
        .client-detail b { font-weight: 800; color: #777777; }
        .footer-text p { margin: 0; line-height: 1.5; }
        .footer-text a { color: #9c9c9c; text-decoration: none; }
        .footer-text h2 { margin: 0; color: #4A2880; font-size: 31px; font-weight: 900; line-height: 1; }
        .top-footer { border-bottom: 2px solid #4A2880; padding: 30px 20px 15px 20px; }
        .bottom-footer { padding: 15px 30px 30px 20px; }
    </style>

</head>

<body>
    <table width="100%">
        <tbody>
            <tr>
                <td width="800" align="center">
                    <table cellpadding="0" cellspacing="0" class="background" style="width: 100%; max-width: 800px;">
                        <tr>
                            <td>
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="header-padding">
                                                <img style="fill:white;" src="{{ asset($brand_settings['logo']) }}" alt="{{ $brand_settings['company_name'] }}" class="logo">
                                            </td>
                                            <td align="right" class="header-padding" style="width: 150px;">
                                                @if (!empty($brand_settings['company_number']) && $brand_settings['company_number'] != false)
                                                    <p>{{ $brand_settings['company_number'] }}</p>
                                                @endif

                                                @if(!empty($brand_settings['company_email']) && $brand_settings['company_email'] != false)
                                                    <p>{{ $brand_settings['company_email'] }}</p>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="white-background" style="width: 100%; max-width: 800px;">
                        <tr>
                            <td class="customer-sec-padding">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="customer-padding" style="width: 200px;">
                                                <h1>Billed To:</h1>
                                                <p>{{ (!empty($firstname) ? $firstname : "") }} {{ (!empty($lastname) ? $lastname : "") }}</p>
                                                <p></p>
                                                <p> 
                                                    {{ (!empty($address) ? $address : "") }}, 
                                                    {{ (!empty($city) ? $city : "") }}, 
                                                    {{ (!empty($statename) ? $statename : "") }},
                                                    {{ (!empty($country) ? $country : "") }}
                                                </p>
                                                <p>{{ (!empty($zipcode) ? $zipcode : "") }}</p>
                                            </td>
                                            <td align="left" class="customer-padding">
                                                <table width="100%">
                                                    <tr>
                                                        <td>
                                                            <h1>Invoice No:</h1>
                                                            <p>{{ (!empty($invoice_id) ? $invoice_id : "") }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top: 20px;">
                                                            <h1>Issue Date:</h1>
                                                            <p>{{ (!empty($created_date) ? $created_date : "") }}</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right" class="customer-padding" style="width: 300px;">
                                                <h1>Invoice Total:</h1>
                                                <h2>{{ (!empty($itemprice) ? $itemprice : "") }}</h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="white-background" style="width: 100%; max-width: 800px;">
                        <tr>
                            <td>
                                <table width="100%" class="background">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="client-heading">
                                                <p>Client Information</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" class="white-background client-table" style="border-bottom: 1px solid #9c9c9c;">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="client-detail">
                                                Full Name
                                            </td>
                                            <td align="left" class="client-detail">
                                                {{ (!empty($firstname) ? $firstname : "") }} {{ (!empty($lastname) ? $lastname : "") }}
                                            </td>
                                        </tr>
                                        <tr class="dark">
                                            <td align="left" class="client-detail">
                                                Company
                                            </td>
                                            <td align="left" class="client-detail">
                                                {{ (!empty($company) ? $company : "") }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" class="client-detail">
                                                Email
                                            </td>
                                            <td align="left" class="client-detail">
                                                {{ (!empty($client_email) ? $client_email : "") }}
                                            </td>
                                        </tr>
                                        <tr class="dark">
                                            <td align="left" class="client-detail">
                                                Phone No
                                            </td>
                                            <td align="left" class="client-detail">
                                                {{ (!empty($phone_number) ? $phone_number : "") }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" class="client-detail">
                                                Order Category
                                            </td>
                                            <td align="left" class="client-detail">
                                                {{ (!empty($category) ? $category : "") }}
                                            </td>
                                        </tr>

                                        @if(!empty($item_desc))
                                            <tr class="dark">
                                                <td align="left" class="client-detail">
                                                    Order Description
                                                </td>
                                                <td align="left" class="client-detail">
                                                    {{ $item_desc }}
                                                </td>
                                            </tr>
                                        @endif

                                    @if(!empty($item_desc))
                                        <tr>
                                    @else
                                        <tr class="dark">
                                    @endif
                                            <td align="left" class="client-detail">
                                                Package Detail
                                            </td>
                                            <td align="left" class="client-detail">
                                                {{ (!empty($itemname) ? $itemname : "") }}
                                                {{ (!empty($itemprice) ? $currency.$itemprice : "") }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table align="right" class="white-background">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="client-detail">
                                                <b>Grand Total</b>
                                            </td>
                                            <td align="left" class="client-detail">
                                                <b>{{ (!empty($itemprice) ? $currency.$itemprice : "") }}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <table cellpadding="0" cellspacing="0" class="white-background" style="width: 100%; max-width: 800px;">
                        <tr>
                            <td class="footer top-footer">
                                <table width="100%" class="white-background">
                                    <tbody>
                                        @if(!empty($brand_settings["company_email"]) || !empty($brand_settings["company_number"]))
                                            <tr>
                                                <td align="left" class="footer-text">
                                                    <p>Questions?</p>
                                                    <p>{{ (!empty($brand_settings["company_email"]) ? 'Email us at '.$brand_settings["company_email"] : "" ) }}</p>

                                                    <p>{{ (!empty($brand_settings["company_number"]) ? 'Email us at '.$brand_settings["company_number"] : "" ) }}</p>
                                                </td>
                                                <td align="right" class="footer-text" style="width: 150px">
                                                    <h2>Thank<br>You!</h2>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        
                        @if(!empty($payment_note))
                            <tr>
                                <td class="footer bottom-footer">
                                    <table width="100%" class="white-background">
                                        <tbody>
                                            <tr>
                                                <td align="left" class="footer-text">
                                                    <p>
                                                        <b>Note:</b> 
                                                        {{ $payment_note }}
                                                        We have received reports of chargebacks recently solely due to the customer not knowing our merchant name for the charges applied to their card, Please remember that our merchant account is </i><b>"Orbit Technologies LLC"</b>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endif
                    </table>


                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>