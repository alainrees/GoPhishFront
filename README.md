# GoPhishFront
Frontend for GoPhish

This frontend was a student project (juli 2019) It's a working product, but due to lack of time some feutures were not finished. Please feel free to finish what was started.

System Requirements:
  CentOS 7
  
# Regarding the Phishing Simulation
The Phishing Simulation will be build inside a framework called Gophish which is created in GO programming language and will be launched in a CENTOS 7 operating system on a Amazon Web Services (AWS) environment.
The Phishing Simulation’ target audience will be the end-users within an organization, company or corporation and its purpose will be to teach the end-users where they make mistakes so they can improve on that and make the company more secure. And to raise awareness regarding Phishing attempts that can take place within the organization, company or corporation.
For the phishing simulation different kind of phishing emails and landing pages based on difficulty are required, these levels of difficulty will be divided into three different levels: Easy, Normal and Hard. Within “Easy” it should be very clear that the Mail is a phishing email, and within the “Hard” level it should be quite difficult to notice that the mail is a phishing email.
The results of the phishing application will create a results report that contains a list of users who were tricked by the application. It will also store information that is filled into the text fields. Password were only allowed to be stored if they were encrypted and not as plain text. In the end the information will show how well a company did in the phishing test.


# Application Configuration
AWS: Instance
CPU: Intel(R) Xeon(R) CPU E5-2676 v3 @ 2.40GHz
Memory Total: 1013192 kB
HDD: 8589 MB
IP: 34.241.71.67
CentOS
User: centos;Welkom_01, root;Welkom_01
Version: CentOS Linux release 7.6.1810 (Core)
Architecture: x86_64
Gophish
User: admin;gophish
Version: 0.7.1
Directory: /opt/gophish/
MySQL
User: root:Welkom_01
Version: mysql Ver 8.0.16 for Linux on x86_64 (MySQL Community Server - GPL)
Directory: /var/lib/mysql
PHPmyadmin
User: root;Welkom_01
Version: 4.4.15.10
Apache
Version: Apache/2.4.6
Directory: /var/www/html/
Firewall
DMZ Ports: 443(https), 80(http), 3333(GoPhish), 22(FTP)
Custom Front-End
User: root@root.com;root
DB User: custom;HelloWorld123!
DB Name: phishing
