# Supported Versions

Magento supported version  1.9.x


# Installation and Configuration

1. Paste the *Magento Plugin/app* folder into your root folder. When prompted to overwrite files, click yes.

2. If you have a linux server make sure the Folder permission are set to 755 and file permission to 644.
 
3. For updating your Zepo Couriers crediantials 

-	Go to file app\design\frontend\base\default\template\couriers\index.php and edit the folloing lines :

-	Edit line number 4 for API Key which will provided to you by Zepo Couriers.

-	Edit line number 6 for Secret Key which will provided to you by Zepo Couriers.

-	Choose the environment Production/Testing. By default Testing will be selected.

-	For production environment comment line number number 8 and uncomment line number 10.

4. Clear Magento Cache and Run Compilation. - DO NOT SKIP THIS STEP
 
5. After you have installed plugin, logout from admin and login again.