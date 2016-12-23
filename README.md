# TA.Gist
TA.Gist is a PHP template that displays your GitHub gists as blog posts

![Sample Gist](https://github.com/tebelorg/TA.Gist/blob/master/media/sample_raw_text_gist.jpeg)

# Why This
If you don't want to spend your life fiddling with themes and plugins just to post something. If you want to have control over layout and styling. If you are the kind of person who, for whatever reason, rather store your content on GitHub.

# Set Up
1. Upload the folders and files to your website root directory
2. Modify /gist/index.php to your website URL and GitHub User ID
3. Choose between option 1 manual update or option 2 auto-index

Make sure /gist/.htaccess is uploaded to map friendly gist URLs

# To Use
1. Create a gist in your GitHub account and save as raw text without extension
2. Save a 1440 x 480 .jpeg image to /media folder using same name as your gist
3. If manual update is chosen, add a line in /gist/index.php for your new gist

Access your beautiful gist at your_website_url/gist/your_gist_name

# Pipeline
Feature|Details
:-----:|:------
Enhancements|feel free to review and suggest new features

# License
TA.Gist is open-source software released under the MIT license
