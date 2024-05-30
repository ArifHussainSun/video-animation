<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name' => 'admin', 
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'status' => 1
        ]);

        $manager = User::create([
            'first_name' => 'Brand', 
            'last_name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('12345678'),
            'created_by' => 1,
            'status' => 1
        ]);

        $salesperson = User::create([
            'first_name' => 'Salesperson', 
            'last_name' => 'BrandX',
            'email' => 'salesperson@gmail.com',
            'password' => bcrypt('12345678'),
            'created_by' => 1,
            'status' => 1
        ]);

        $developer = User::create([
            'first_name' => 'Developer', 
            'last_name' => 'BrandX',
            'email' => 'developer@gmail.com',
            'password' => bcrypt('12345678'),
            'created_by' => 1,
            'status' => 1
        ]);

        $customer = User::create([
            'first_name' => 'Customer', 
            'last_name' => 'BrandX',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('12345678'),
            'created_by' => 1,
            'status' => 1
        ]);
    
        $adminRole = Role::create(['name' => 'Admin']);
        $brandManagerRole = Role::create(['name' => 'Brand Manager']);
        $salespersonRole = Role::create(['name' => 'Salesperson']);
        $developerRole = Role::create(['name' => 'Developer']);
        $customerRole = Role::create(['name' => 'Customer']);

        //Assigning roles to users
        $admin->assignRole([$adminRole->id]);
        $manager->assignRole([$brandManagerRole->id]);
        $salesperson->assignRole([$salespersonRole->id]);
        $developer->assignRole([$developerRole->id]);
        $customer->assignRole([$customerRole->id]);

        //Permissions Module Wise
        $Userpermission1 = Permission::create(['name'=>'User-Create','guard_name'=>'web']);
        $Userpermission2 = Permission::create([ 'name'=>'User-Edit','guard_name'=>'web', ]);
        $Userpermission3 = Permission::create([ 'name'=>'User-View', 'guard_name'=>'web', ]);
        $Userpermission4 = Permission::create([ 'name'=>'User-Delete', 'guard_name'=>'web', ]);
        
        //$permissions = Permission::pluck('id','id')->all();
        //$adminRole->syncPermissions($Userpermission);

        //Allot Permissions
        $Permission1 = Permission::create(['name' => 'Permission-Create','guard_name' => 'web']);
        $Permission2 = Permission::create(['name' => 'Permission-Edit','guard_name' => 'web']);
        $Permission3 = Permission::create(['name' => 'Permission-View','guard_name' => 'web']);
        $Permission4 = Permission::create(['name' => 'Permission-Delete','guard_name' => 'web']);

        //ContactQueries Permissions
        $ContactQueries1 = Permission::create(['name' => 'ContactQueries-Create','guard_name' => 'web']);
        $ContactQueries2 = Permission::create(['name' => 'ContactQueries-Edit','guard_name' => 'web']);
        $ContactQueries3 = Permission::create(['name' => 'ContactQueries-View','guard_name' => 'web']);
        $ContactQueries4 = Permission::create(['name' => 'ContactQueries-Delete','guard_name' => 'web']);
        
        //Subscriber Permissions
        $Subscriber1 = Permission::create(['name' => 'Subscriber-Create','guard_name' => 'web']);
        $Subscriber2 = Permission::create(['name' => 'Subscriber-Edit','guard_name' => 'web']);
        $Subscriber3 = Permission::create(['name' => 'Subscriber-View','guard_name' => 'web']);
        $Subscriber4 = Permission::create(['name' => 'Subscriber-Delete','guard_name' => 'web']);
        
        //Customer Permissions
        $Customer1 = Permission::create(['name' => 'Customer-Create','guard_name' => 'web']);
        $Customer2 = Permission::create(['name' => 'Customer-Edit','guard_name' => 'web']);
        $Customer3 = Permission::create(['name' => 'Customer-View','guard_name' => 'web']);
        $Customer4 = Permission::create(['name' => 'Customer-Delete','guard_name' => 'web']);

        //Role Permissions
        $Role1 = Permission::create(['name' => 'Role-Create','guard_name' => 'web']);
        $Role2 = Permission::create(['name' => 'Role-Edit','guard_name' => 'web']);
        $Role3 = Permission::create(['name' => 'Role-View','guard_name' => 'web']);
        $Role4 = Permission::create(['name' => 'Role-Delete','guard_name' => 'web']);
        
        //EmailTemplate Permissions
        $EmailTemplate1 = Permission::create(['name' => 'EmailTemplate-Create','guard_name' => 'web']);
        $EmailTemplate2 = Permission::create(['name' => 'EmailTemplate-Edit','guard_name' => 'web']);
        $EmailTemplate3 = Permission::create(['name' => 'EmailTemplate-View','guard_name' => 'web']);
        $EmailTemplate4 = Permission::create(['name' => 'EmailTemplate-Delete','guard_name' => 'web']);
        
        //Gallery Permissions
        $Gallery1 = Permission::create(['name' => 'Gallery-Create','guard_name' => 'web']);
        $Gallery2 = Permission::create(['name' => 'Gallery-Edit','guard_name' => 'web']);
        $Gallery3 = Permission::create(['name' => 'Gallery-View','guard_name' => 'web']);
        $Gallery4 = Permission::create(['name' => 'Gallery-Delete','guard_name' => 'web']);
        
        //Gallery Permissions
        $Coupon1 = Permission::create(['name' => 'Coupon-Create','guard_name' => 'web']);
        $Coupon2 = Permission::create(['name' => 'Coupon-Edit','guard_name' => 'web']);
        $Coupon3 = Permission::create(['name' => 'Coupon-View','guard_name' => 'web']);
        $Coupon4 = Permission::create(['name' => 'Coupon-Delete','guard_name' => 'web']);

        //Categories Permissions
        $Categories1 = Permission::create(['name' => 'Categories-Create','guard_name' => 'web']);
        $Categories2 = Permission::create(['name' => 'Categories-Edit','guard_name' => 'web']);
        $Categories3 = Permission::create(['name' => 'Categories-View','guard_name' => 'web']);
        $Categories4 = Permission::create(['name' => 'Categories-Delete','guard_name' => 'web']);


        //Portfolio Permissions
        $Portfolio1 = Permission::create(['name' => 'Portfolio-Create','guard_name' => 'web']);
        $Portfolio2 = Permission::create(['name' => 'Portfolio-Edit','guard_name' => 'web']);
        $Portfolio3 = Permission::create(['name' => 'Portfolio-View','guard_name' => 'web']);
        $Portfolio4 = Permission::create(['name' => 'Portfolio-Delete','guard_name' => 'web']);
        
        //Portfolio Permissions
        $Service1 = Permission::create(['name' => 'Service-Create','guard_name' => 'web']);
        $Service2 = Permission::create(['name' => 'Service-Edit','guard_name' => 'web']);
        $Service3 = Permission::create(['name' => 'Service-View','guard_name' => 'web']);
        $Service4 = Permission::create(['name' => 'Service-Delete','guard_name' => 'web']);


        //SubCategories Permissions
        $SubCategories1 = Permission::create(['name' => 'SubCategories-Create','guard_name' => 'web']);
        $SubCategories2 = Permission::create(['name' => 'SubCategories-Edit','guard_name' => 'web']);
        $SubCategories3 = Permission::create(['name' => 'SubCategories-View','guard_name' => 'web']);
        $SubCategories4 = Permission::create(['name' => 'SubCategories-Delete','guard_name' => 'web']);
        
        //Product Permissions
        $Product1 = Permission::create(['name' => 'Product-Create','guard_name' => 'web']);
        $Product2 = Permission::create(['name' => 'Product-Edit','guard_name' => 'web']);
        $Product3 = Permission::create(['name' => 'Product-View','guard_name' => 'web']);
        $Product4 = Permission::create(['name' => 'Product-Delete','guard_name' => 'web']);
        
        //Page Permissions
        $Page1 = Permission::create(['name' => 'Page-Create','guard_name' => 'web']);
        $Page2 = Permission::create(['name' => 'Page-Edit','guard_name' => 'web']);
        $Page3 = Permission::create(['name' => 'Page-View','guard_name' => 'web']);
        $Page4 = Permission::create(['name' => 'Page-Delete','guard_name' => 'web']);
        
        //Testimonial Permissions
        $Testimonial1 = Permission::create(['name' => 'Testimonial-Create','guard_name' => 'web']);
        $Testimonial2 = Permission::create(['name' => 'Testimonial-Edit','guard_name' => 'web']);
        $Testimonial3 = Permission::create(['name' => 'Testimonial-View','guard_name' => 'web']);
        $Testimonial4 = Permission::create(['name' => 'Testimonial-Delete','guard_name' => 'web',]);
        
        //Faq Permissions
        $Faq1 = Permission::create(['name' => 'Faq-Create','guard_name' => 'web']);
        $Faq2 = Permission::create(['name' => 'Faq-Edit','guard_name' => 'web']);
        $Faq3 = Permission::create(['name' => 'Faq-View','guard_name' => 'web']);
        $Faq4 = Permission::create(['name' => 'Faq-Delete','guard_name' => 'web']);
        
        //Partner Permissions
        $Partner1 = Permission::create(['name' => 'Partner-Create','guard_name' => 'web']);
        $Partner2 = Permission::create(['name' => 'Partner-Edit','guard_name' => 'web']);
        $Partner3 = Permission::create(['name' => 'Partner-View','guard_name' => 'web']);
        $Partner4 = Permission::create(['name' => 'Partner-Delete','guard_name' => 'web']);
        
        //Payment Permissions
        $Payment1 = Permission::create(['name' => 'Payment-Create','guard_name' => 'web']);
        $Payment2 = Permission::create(['name' => 'Payment-Edit','guard_name' => 'web']);
        $Payment3 = Permission::create(['name' => 'Payment-View','guard_name' => 'web']);
        $Payment4 = Permission::create(['name' => 'Payment-Delete','guard_name' => 'web']);
        
        //PaymentLinkGenerator Permissions
        $PaymentLinkGenerator1 = Permission::create(['name' => 'PaymentLinkGenerator-Create','guard_name' => 'web']);
        $PaymentLinkGenerator2 = Permission::create(['name' => 'PaymentLinkGenerator-Edit','guard_name' => 'web']);
        $PaymentLinkGenerator3 = Permission::create(['name' => 'PaymentLinkGenerator-View','guard_name' => 'web']);
        $PaymentLinkGenerator4 = Permission::create(['name' => 'PaymentLinkGenerator-Delete','guard_name' => 'web']);
    
        
        //Assign Permissions to Roles

        //Add Permissions to adminRole 
        $adminRole->givePermissionTo([$Userpermission1, $Userpermission2, $Userpermission3, $Userpermission4]);
        $adminRole->givePermissionTo([$Permission1, $Permission2, $Permission3, $Permission4]);
        $adminRole->givePermissionTo([$ContactQueries1, $ContactQueries2, $ContactQueries3, $ContactQueries4]);
        $adminRole->givePermissionTo([$Subscriber1, $Subscriber2, $Subscriber3, $Subscriber4]);
        $adminRole->givePermissionTo([$Customer1, $Customer2, $Customer3, $Customer4]);
        $adminRole->givePermissionTo([$Role1, $Role2, $Role3, $Role4]);
        $adminRole->givePermissionTo([$EmailTemplate1, $EmailTemplate2, $EmailTemplate3, $EmailTemplate4]);
        $adminRole->givePermissionTo([$Gallery1, $Gallery2, $Gallery3, $Gallery4]);
        $adminRole->givePermissionTo([$Coupon1, $Coupon2, $Coupon3, $Coupon4]);
        $adminRole->givePermissionTo([$Categories1, $Categories2, $Categories3, $Categories4]);
        $adminRole->givePermissionTo([$Portfolio1, $Portfolio2, $Portfolio3, $Portfolio4]);
        $adminRole->givePermissionTo([$Service1, $Service2, $Service3, $Service4]);
        $adminRole->givePermissionTo([$SubCategories1, $SubCategories2, $SubCategories3, $SubCategories4]);
        $adminRole->givePermissionTo([$Product1, $Product2, $Product3, $Product4]);
        $adminRole->givePermissionTo([$Page1, $Page2, $Page3, $Page4]);
        $adminRole->givePermissionTo([$Testimonial1, $Testimonial2, $Testimonial3, $Testimonial4]);
        $adminRole->givePermissionTo([$Faq1, $Faq2, $Faq3, $Faq4]);
        $adminRole->givePermissionTo([$Partner1, $Partner2, $Partner3, $Partner4]);
        $adminRole->givePermissionTo([$Payment1, $Payment2, $Payment3, $Payment4]);
        $adminRole->givePermissionTo([$PaymentLinkGenerator1, $PaymentLinkGenerator2, $PaymentLinkGenerator3, $PaymentLinkGenerator4]);
        
        //Add Permissions to brandManagerRole 
        $brandManagerRole->givePermissionTo([$Userpermission1, $Userpermission2, $Userpermission3, $Userpermission4]);
        //$brandManagerRole->givePermissionTo([$Permission1, $Permission2, $Permission3, $Permission4]);
        $brandManagerRole->givePermissionTo([$ContactQueries1, $ContactQueries2, $ContactQueries3, $ContactQueries4]);
        $brandManagerRole->givePermissionTo([$Subscriber1, $Subscriber2, $Subscriber3, $Subscriber4]);
        $brandManagerRole->givePermissionTo([$Customer1, $Customer2, $Customer3, $Customer4]);
        $brandManagerRole->givePermissionTo([$Role1, $Role2, $Role3, $Role4]);
        $brandManagerRole->givePermissionTo([$EmailTemplate1, $EmailTemplate2, $EmailTemplate3, $EmailTemplate4]);
        $brandManagerRole->givePermissionTo([$Categories1, $Categories2, $Categories3, $Categories4]);
        $brandManagerRole->givePermissionTo([$Portfolio1, $Portfolio2, $Portfolio3, $Portfolio4]);
        $brandManagerRole->givePermissionTo([$Service1, $Service2, $Service3, $Service4]);
        $brandManagerRole->givePermissionTo([$SubCategories1, $SubCategories2, $SubCategories3, $SubCategories4]);
        $brandManagerRole->givePermissionTo([$Product1, $Product2, $Product3, $Product4]);
        //$brandManagerRole->givePermissionTo([$Page1, $Page2, $Page3, $Page4]);
        $brandManagerRole->givePermissionTo([$Testimonial1, $Testimonial2, $Testimonial3, $Testimonial4]);
        $brandManagerRole->givePermissionTo([$Faq1, $Faq2, $Faq3, $Faq4]);
        $brandManagerRole->givePermissionTo([$Partner1, $Partner2, $Partner3, $Partner4]);
        $brandManagerRole->givePermissionTo([$Payment1, $Payment2, $Payment3, $Payment4]);
        $brandManagerRole->givePermissionTo([$PaymentLinkGenerator1, $PaymentLinkGenerator2, $PaymentLinkGenerator3, $PaymentLinkGenerator4]);
        
        //Add Permissions to salespersonRole 
        //$salespersonRole->givePermissionTo([$Userpermission1, $Userpermission2, $Userpermission3, $Userpermission4]);
        //$salespersonRole->givePermissionTo([$Userpermission1, $Userpermission2, $Userpermission3, $Userpermission4]);
        //$salespersonRole->givePermissionTo([$Permission1, $Permission2, $Permission3, $Permission4]);
        $salespersonRole->givePermissionTo([$ContactQueries1, $ContactQueries2, $ContactQueries3, $ContactQueries4]);
        $salespersonRole->givePermissionTo([$Subscriber1, $Subscriber2, $Subscriber3, $Subscriber4]);
        $salespersonRole->givePermissionTo([$Customer1, $Customer2, $Customer3,]);
        //$salespersonRole->givePermissionTo([$Role1, $Role2, $Role3, $Role4]);
        $salespersonRole->givePermissionTo([$EmailTemplate1, $EmailTemplate2, $EmailTemplate3, $EmailTemplate4]);
        //$salespersonRole->givePermissionTo([$Categories1, $Categories2, $Categories3, $Categories4]);
        //$salespersonRole->givePermissionTo([$SubCategories1, $SubCategories2, $SubCategories3, $SubCategories4]);
        //$salespersonRole->givePermissionTo([$Product1, $Product2, $Product3, $Product4]);
        //$salespersonRole->givePermissionTo([$Page1, $Page2, $Page3, $Page4]);
        $salespersonRole->givePermissionTo([$Testimonial1, $Testimonial2, $Testimonial3, $Testimonial4]);
        //$salespersonRole->givePermissionTo([$Faq1, $Faq2, $Faq3, $Faq4]);
        //$salespersonRole->givePermissionTo([$Partner1, $Partner2, $Partner3, $Partner4]);
        $salespersonRole->givePermissionTo([$Payment1, $Payment2, $Payment3, $Payment4]);
        $salespersonRole->givePermissionTo([$PaymentLinkGenerator1, $PaymentLinkGenerator2, $PaymentLinkGenerator3, $PaymentLinkGenerator4]);
        
        //Add Permissions to developerRole 
        $developerRole->givePermissionTo([$Userpermission1, $Userpermission2, $Userpermission3, $Userpermission4]);
        $developerRole->givePermissionTo([$Userpermission1, $Userpermission2, $Userpermission3, $Userpermission4]);
        $developerRole->givePermissionTo([$Permission1, $Permission2, $Permission3, $Permission4]);
        $developerRole->givePermissionTo([$ContactQueries1, $ContactQueries2, $ContactQueries3, $ContactQueries4]);
        $developerRole->givePermissionTo([$Subscriber1, $Subscriber2, $Subscriber3, $Subscriber4]);
        //$developerRole->givePermissionTo([$Customer1, $Customer2, $Customer3,]);
        $developerRole->givePermissionTo([$Role1, $Role2, $Role3, $Role4]);
        $developerRole->givePermissionTo([$EmailTemplate1, $EmailTemplate2, $EmailTemplate3, $EmailTemplate4]);
        $developerRole->givePermissionTo([$Categories1, $Categories2, $Categories3, $Categories4]);
        $developerRole->givePermissionTo([$Portfolio1, $Portfolio2, $Portfolio3, $Portfolio4]);
        $developerRole->givePermissionTo([$Service1, $Service2, $Service3, $Service4]);
        $developerRole->givePermissionTo([$SubCategories1, $SubCategories2, $SubCategories3, $SubCategories4]);
        $developerRole->givePermissionTo([$Product1, $Product2, $Product3, $Product4]);
        $developerRole->givePermissionTo([$Page1, $Page2, $Page3, $Page4]);
        $developerRole->givePermissionTo([$Testimonial1, $Testimonial2, $Testimonial3, $Testimonial4]);
        $developerRole->givePermissionTo([$Faq1, $Faq2, $Faq3, $Faq4]);
        $developerRole->givePermissionTo([$Partner1, $Partner2, $Partner3, $Partner4]);
        $developerRole->givePermissionTo([$Payment1, $Payment2, $Payment3, $Payment4]);
        $developerRole->givePermissionTo([$PaymentLinkGenerator1, $PaymentLinkGenerator2, $PaymentLinkGenerator3, $PaymentLinkGenerator4]);
        
        //Add Permissions to customerRole 
        $customerRole->givePermissionTo([$Customer3]);
        $customerRole->givePermissionTo([$Payment3]);
    }
}