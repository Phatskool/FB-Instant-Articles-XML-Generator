# FB Instant Articles XML Generator
 Custom XML Generator that receives article data from DB - Fully Compatible with FB - Greek Language Optimized

 Install Instructions:
1. Download zip files and unnzip everything  via FTP in your plugins directory/path in your server.
 
2. Change facebookfeed.php settings (db,passwords,desired db tables etc)

3. Visit facebookfeed.php page on your domain path

Alternativeley you can use a cron job from your server and "run" the code  e.g. once a day

4. Voila! facebook.xml is ready to be submited on Facebook

More information about the exact lines you need to change, can be found in facebookfeed.php comments
 
 FAQ:
 
 A. Missing Logo: 
 
 Do not forget to upload a logo on facebook:
Go to your fb page, select tab: "Publishing Tools",
Go to Instant Articles > Configuration on your left,
 Under the tools section you will find Styles tab,  click on default,
 select Logo from the left of your screen and upload your logo :)
 
 B. I cannot see Instant Articles on my publishing tools.
 1. Visit https://www.facebook.com/instant_articles/signup
 2. Register your page,
 3. Claim your url by uploading a meta tag on your  header file,
 it should look something like ```<meta property="fb:pages" content="10110101010" />```
 4. Go to your fb page, select tab: "Publishing Tools",
Go to Instant Articles > Configuration on your left,
Under the tools tab, select Development RSS Feed or Production RSS Feed depending if the xml has no errors and is ready to submit
 5. Submit your xml (full-path-to/facebook.xml)
 6. Press save
 7. Check for errors
 8. Under "Step 2 : Submit for review", click the Submit Button
 
 
 Questions? custom work?
 Contact me for info!
 https://gr.linkedin.com/in/giannis-mihelakis-4bb710177