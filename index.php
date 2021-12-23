<!DOCTYPE html>
<!-- 2021 (c) designed and built by Ikatyros NY. All rights reserved.  -->
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Henna Parkkinen portfolio website." />
    <meta name="keywords" content="henna, parkkinen, photography, valokuvaus, mallinnus, styling, pinterest like layouts" />
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="./img/henna.png" type="image/x-icon">
    <title>Henna Parkkinen</title>
    
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/font-awesome.css">
    <link rel="stylesheet" href="./css/animate.css">
    <link rel="stylesheet" href="./css/templatemo-misc.css">
    <link rel="stylesheet" href="./css/templatemo-style.css">
    
    <script type="text/javascript" src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
</head>

<body>
    <section id="pageloader">
        <div class="loader-item fa fa-spin colored-border"></div>
    </section>

    <header class="site-header container-fluid">
        <div class="top-header">
            <div class="logo col-md-6 col-sm-6">
                <div class="burger">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <h1>Henna Parkkinen</h1>
            </div>
            <div class="social-top col-md-6 col-sm-6">
                <ul>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                    <li><a href="#" class="fa fa-rss"></a></li>
                    <!-- <li><a href="#" class="fa fa-instagram"></a></li> -->
                    <!-- <li><a href="#" class="fa fa-twitter"></a></li> -->
                    <!-- <li><a href="#" class="fa fa-linkedin"></a></li> -->
                    <!-- <li><a href="#" class="fa fa-google-plus"></a></li> -->
                    <!-- <li><a href="#" class="fa fa-flickr"></a></li> -->
                </ul>
            </div>
        </div>
        <!-- <div id="responsive-menu">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="#">Projects</a>
                    <ul>
                        <li><a href="projects-2.html">Two Columns</a></li>
                        <li><a href="projects-3.html">Three Columns</a></li>
                        <li><a href="project-details.html">Project Single</a></li>
                    </ul>
                </li>
                <li><a href="#">Blog</a>
                    <ul>
                        <li><a href="blog.html">Blog Masonry</a></li>
                        <li><a href="blog-single.html">Post Single</a></li>
                    </ul>
                </li>
                <li><a href="#">Pages</a>
                    <ul>
                        <li><a href="our-team.html">Our Team</a></li>
                        <li><a href="archives.html">Archives</a></li>
                        <li><a href="grids.html">Columns</a></li>
                        <li><a href="404.html">404 Page</a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div> -->
    </header>

    <div class="content-wrapper">
        <div class="inner-container container">
            <!-- <div class="row">
                <div class="section-header col-md-12" style="text-align: center;">
                    <h2>My projects</h2>
                </div>
            </div> -->
            <div class="row">
                <div class="blog-masonry masonry-true"></div>
            </div>
            <div class="row" style="text-align: center; margin-top: 1rem; margin-bottom: 3rem;">
                <img src="https://m.ikatyros.com/ikatyros-simplified.png" alt="This site has been built by Ikatyros." style="width: 2rem; height: 2rem;">
                Ikatyros NY 2021
            </div>
        </div>
    </div>

    <div>
        +358 443072299
        henna_parkkinen@hotmail.com
    </div>

    <div class="about">
        <div id="a">
            <h1>About</h1>
            <a href="https://instagram.com/henna.parkkinen" target="#">Instagram</a>
            <a href="./content/cv.pdf" target="#">CV</a>
        </div>
        <div id="b">
            <img src="./content/portrait.jpg" alt="Portrait of me">
            <p>We're no strangers to love. You know the rules and so do I. A full commitment's what I'm thinking of. You wouldn't get this from any other guy. I just wanna tell you how I'm feeling. Gotta make you understand. Never gonna give you up.</p>
        </div>
    </div>

    <script src="js/vendor/jquery-1.11.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="js/index.js"></script>

<?php
if (isset($_COOKIE['admin_rights'])) {
    echo `
        <div class="admin-controls-toggle">
            <button><img src="./img/settings.png" alt=""></button>
        </div>
        <div class="admin-controls">
            <input type="range" name="project_size" min="1" max="4">
            <button id="randomize">Randomize</button>
            <button id="reset">Reset</button>
            <button id="save">Save Layout</button>
        </div>
    `;
}
?>

<?php
function getProjectsFromJson($directory, $fileName) {
    $projects = array();
    $dir = str_replace("\\", "/", (__DIR__ . "/" . $directory . "/"));
    $path = $dir . $fileName . ".json";
    $json = json_decode(trim(file_get_contents($path)), true);
    // this loop gets each image in json's "projects" array
    // and sets them up correctly in the 'projects' array
    foreach ($json['projects'] as $project) {
        $id = $project['id'];
        $img = array();
        foreach (new DirectoryIterator($dir . 'projects/' . $id) as $file) {
            if ($file->isDot()) continue;
            $fileName = $file->getFilename();
            array_unshift($img , "$fileName");
            array_reverse($img, false);
        }
        $projects[] = array(
            "id" => $id,
            "title" => $project['title'],
            "thumb" => $img[$project['thumb']],
            "categories" => $project['categories'],
            "description" => $project['description'],
            "layout" => $project['layout'],
            "img" => $img
        );
    }
    return json_encode($projects, JSON_HEX_AMP | JSON_HEX_TAG);
}
$projects = getProjectsFromJson("content", "index");
echo "<script type='text/javascript'>setProjects('$projects')</script>";
?>
</body>
</html>