    <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>LogoFie</title>
    <style>
    .invoice-box{ max-width:800px; margin:auto; padding: 30px; border:1px solid #eee; box-shadow:0 0 10px rgba(0, 0, 0, .15); font-size:16px; line-height:24px; font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; color:#555; }
    .invoice-box table{ width:100%; line-height:inherit; text-align: left; }
    .invoice-box table td{ padding:5px; vertical-align:top; }
    .invoice-box table tr td:nth-child(2){ text-align: right; }
    .invoice-box table tr.top table td{ padding-bottom:20px; }
    .invoice-box table tr.top table td.title { font-size:45px; line-height:45px; color:#333; }
    .invoice-box table tr.information table td{ padding-bottom:40px; }
    .invoice-box table tr.heading td{ background:#eee; border-bottom:1px solid #ddd; font-weight:bold; }
    .invoice-box table tr.details td{ padding-bottom:1px solid #eee; }
    .invoice-box table tr.item td{ border-bottom:1px solid #eee; }
    .invoice-box table tr.item.last td{ border-bottom:none; }
    .invoice-box table tr.total td:nth-child(2){ border-top:2px solid #eee; font-weight:bold; }
    .btn-div { margin-bottom: 30px; margin-top: 10px; }
    .btn-div a { background: linear-gradient(to right, #5e42d3 0%, #5e42d3 100%) !important; margin-left: 10px; color: white; font-weight: 600; border-radius: 4px; padding: 12px 45px; margin: 0 auto; text-align: center; text-decoration: none; margin-left: 20px; }
    .highlight{ background: linear-gradient(to right, #5e42d3 0%, #5e42d3 100%); color: white; padding: 4px; border-radius: 10px; }
    #read_main { display: none; }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{ width:100%; display:block; text-align:center; }
        .invoice-box table tr.information table td{ width:100%; display:block; text-align:center; }
    }
    </style>

</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo base_url(); ?>assets/images/logo.png" style="width:100%; max-width:200px;">
                                <img id="read_main" src="<?php echo base_url(); ?>/brief/read_email/<?php echo (isset($brief[0]->id) ? $brief[0]->id : '' ); ?>">
                            </td>
                            
                        </tr>
                    </table>
                </td>
            </tr>
          
            <tr class="heading">
                <td>
                    Client Information For Logo Design
                </td>
                
                <td>
                    
                </td>
            </tr>
            
            <?php if(!empty($brief[0]->additional_service)){ ?>
            
                <tr class="item">
                    <td> Services </td>
                    
                    <td>
                        <?php 
                            $services = explode(',' , $brief[0]->additional_service);
                            
                            foreach($services as $i =>$service) {
                               echo '<span class="highlight">'.$service.'</span> ';
                            }
                        ?>
                    </td>
                </tr>
                
            <?php } ?>
            
            <tr class="item">
                <td> Customer Name </td>
                
                <td>
                    <b><?php echo $brief[0]->cus_name;?></b>
                </td>
            </tr>
            <tr class="item">
                <td> Company Name </td>
                
                <td>
                    <b><?php echo $brief[0]->company_name; ?></b>
                </td>
            </tr>
            <tr class="item">
                <td> Customer Email </td>
                
                <td>
                    <b><?php echo $brief[0]->cus_email;?></b>
                </td>
            </tr>
            
            <?php if(!empty($brief[0]->cus_phone) && $brief[0]->cus_phone>0) { ?>
                <tr class="item">
                    <td> Mobile No # </td>
                    
                    <td>
                        <b><?php echo $brief[0]->cus_phone; ?></b>
                    </td>
                </tr>
            <?php } ?>
            
            <?php if(!empty($brief[0]->logos)){ ?>
            
                <tr class="item">
                    <td> Nature of Business </td>
                    
                    <td>
                        <?php 
                            $business_types = explode(',' , $brief[0]->logos);
                            
                            foreach($business_types as $i =>$key) {
                               echo '<span class="highlight">'.$key.'</span> ';
                            }
                        ?>
                    </td>
                </tr>
                
            <?php } ?>
            
            <?php if(!empty($brief[0]->colors)){ ?>
                <tr class="item">
                    <td> Colors </td>
                    
                    <td>
                        <?php
                            $selected_colors = explode(",", $brief[0]->colors);
                            foreach($selected_colors as $color) {
                                echo '<span class="highlight">'.$color.'</span> ';
                                //echo '<img src="'.$color.'" width="100px" height="100px">  ';
                            }
                        ?>
                    </td>
                </tr>
            <?php } ?>
            
            <?php if(!empty($brief[0]->industry)){ ?>
                <tr class="item">
                    <td> Industry </td>
                    
                    <td>
                        <?php
                            $selected_industries = explode(",", $brief[0]->industry);
                            foreach($selected_industries as $industry) {
                                echo '<span class="highlight">'.$industry.'</span> ';
                            }
                        ?>
                    </td>
                </tr>
            <?php } ?>
            
            <?php if(!empty($brief[0]->logo_style)){ ?>
                <tr class="item">
                    <td> Logo Style </td>
                    
                    <td>
                        <?php
                            $logo_styles = explode(",", $brief[0]->logo_style);
                            foreach($logo_styles as $logo_style) {
                                echo '<span class="highlight">'.$logo_style.'</span> ';
                            }
                        ?>
                    </td>
                </tr>
            <?php } ?>
            
            <?php if(!empty($brief[0]->logo_type)){ ?>
                <tr class="item">
                    <td> Logo Type </td>
                    
                    <td>
                        <?php 
                            $logos = explode(",", $brief[0]->logo_type);
                            
                            foreach($logos as $type) {
                                echo '<span class="highlight">'.$type.'</span> ';
                            }
                        ?>
                        
                    </td>
                </tr>
            <?php } ?>
            
            <?php if(!empty($brief[0]->website_type)){ ?>
                <tr class="item">
                    <td> Website Type </td>
                    
                    <td>
                        <?php 
                            $website_types = explode(",", $brief[0]->website_type);
                            
                            foreach($website_types as $webType) {
                                echo '<span class="highlight">'.$webType.'</span> ';
                            }
                        ?>
                        
                    </td>
                </tr>
            <?php } ?>
            
            <?php if(!empty($brief[0]->website_style)){ ?>
                <tr class="item">
                    <td> Website Style </td>
                    
                    <td>
                        <?php 
                            $website_styles = explode(",", $brief[0]->website_style);
                            
                            foreach($website_styles as $webStyle) {
                                echo '<span class="highlight">'.$webStyle.'</span> ';
                            }
                        ?>
                        
                    </td>
                </tr>
            <?php } ?>
            
            
        </table>
    </div>
</body>
</html>
