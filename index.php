<script>
    // Check if the user is logged in and display their username
    window.onload = function() {
        const welcomeContainer = document.querySelector(".welcome-container");
        const First_Name = "<?php echo isset($_SESSION['First_Name']) ? $_SESSION['First_Name'] : '' ?>";
        if (First_Name) {
            welcomeContainer.innerHTML = "Welcome, " + First_Name + "!";
        }
    };
    
</script>
    <!DOCTYPE 
    <html lang="en"><head>
    <link href="goldy-home1.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0">
    <title>GOLDY</title>
    <style type="text/css" id="operaUserStyle"></style>
    </head>
    <body class="body" data-new-gr-c-s-check-loaded="14.1154.0" data-gr-ext-installed="">
    <div class="navigation w-nav" style="
        border-bottom: 2px solid;">
            <div class="navigation-items">
            <div class="logo-block">
                <img src="logo-header.png" style="
                width: 190px;
            ">
            </div>
            
            <div>
        
    <div class="navigation-wrap">
                <nav role="navigation" class="navigation-items w-nav-menu">
                <a href="index.php" aria-current="page" class="navigation-item w-nav-link w--current">Home</a>
                <a href="goldy-about.html" class="navigation-item w-nav-link">About</a>
                <a href="guinto-certificates.html" class="navigation-item w-nav-link">Certificate</a>
            </nav>
        
            </div>
            </div>
            
            </div>
            <div class="welcome-container" style=""></div>
        <a style="padding-top: 5px;height: 33px;width: 82px;background: #ffc400c4;float: inline-end;margin-right: 2px;text-align: center;border-radius: 10px;
    " class="btn btn-warning" href="logout.php">Logout</a></div>
        <div class="section">
            <div class="container" style="">
            <div class="intro-wrap">
                <div class="name-text">Julianne Guinto</div>
                <div class="paragraph-light">Web Developer<br>
            </div>
            <h1 class="heading-jumbo">I'm a new developer who is still learning how to code. I'm learning every day, and I hope you find some fun along with me. </h1>
        </div>
            </div>
        </div>
        <div class="section">
            <div id="works-grid" class="w-layout-grid works-grid">
            <div style="grid-area: 1 / 1 / 2 / 3;" id="project-1">
                <a href="goldy-about.html" class="work-image cc-work-1 w-inline-block"></a>
                <div class="work-description">
                <div class="project-name-link">ABOUT ME</div>
                </div>
            </div>
            <div style="grid-area: 1 / 3 / 1 / 4;" id="project-2">
                <a href="guinto-certificates.html" class="work-image cc-work-2 w-inline-block"></a>
                <div class="work-description">
                    <div class="paragraph-light">Works &amp; Certificate</div>
                </div>
            </div>

            </div>
            </div>
            <div style="padding: 10px 25px;margin: 37px 145px;width: 693px;background: #32202f7d;border-radius: 25px;
">
<div id="comment-section">
    <h2>Drop me a line!</h2>
<p style="
    margin: 0;
    margin-bottom: 10px;
    font-style: italic;
">give me some feedback :&gt;</p>
    <form action="comment.php" method="POST"> <!-- Updated action attribute -->
  
<label for="username" style="
    font-family: inherit;
    font-size: larger;
">Name:</label>
<input type="text" id="username" name="username" required="" style="
    padding-left: 8px;
    height: 37px;
    width: 194px;
    background: #c6d1dbe8;
    border: none;
    border-radius: 10px;
">
          <br> 
          <div style="margin:27px 0"></div>
<label for="message" style="
    font-size: larger;
    margin: 10px 0;
">Comment:</label>
<br>
<textarea id="message" name="message" rows="4" required="" style="
    height: 93px;
    width: 396px;
    background: #c6d1dbe8;
    border: none;
    border-radius: 10px;
    margin-bottom: 20px;
"></textarea>
        <br>
        <button type="submit" style="
    border: none;
    border-radius: 10px;
    background: #b273b7;
    height: 40px;
    width: 95px;
    font-size: unset;
    font-family: inherit;
    margin-left: 2px;
">Submit</button>
    </form>
</div>
</div>

    <div class="footer-wrap">
            <div>
                <div class="paragraph-tiny">GOLDY</div>
            </div>
            <div class="footer-links">
                <a href="https://www.facebook.com/julianne.guinto.5/" target="_blank" class="footer-item">Facebook</a>
                <a href="https://x.com/goldswrl?t=_mCswPmiQdBeFlVid4w_gQ&amp;s=09" class="footer-item">Twitter</a>
                <a href="https://www.instagram.com/julianne.guinto/" target="_blank" class="footer-item">Instagram</a>
        </div>
        </div>
    
    </div>
    </body>
    <grammarly-desktop-integration data-grammarly-shadow-root="true">

    </grammarly-desktop-integration>
    <div id="smartyContainer" style="position: absolute; top: 0px; right: 0px; line-height: initial; z-index: 2147483647; width: auto; font-size: initial;">
    </div>
    </html>