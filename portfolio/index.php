<?php 
require_once __DIR__. "/../controllers/userController.php";
$usercontroller = new UserController();
$user = $usercontroller->getAllUsers(12);

?>
<head>
    <meta charset="UTF-8">
    <title>Ajay Bhayadyo | Portfolio</title>
    <link rel="stylesheet" href="/../collab-training/public/portfolio/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- navbar for my site -->
    <nav>
        <div class="nave">
            <div class="logo"></div>
            <div class="nav1">
                <a href="#skills">Skills</a>
                <a href="#projects">Projects</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
    </nav>
    <!-- end -->

    <!-- img showing hero section -->
    <header>
        <div class="hero">
            <div class="head">
                <p>I Am <?php echo $user['fullname']?></p>
                <h1>BSc CSIT </h1>
                <button id="but">Contact Me</button>
            </div>
             <img src="/../collab-training/public/images/profilepic/<?php echo $user['pimage'] ?>" class="pic">
        </div>
    </header>
    <!-- endofhero -->
    
    <!-- about me section -->
    <section>
        <div id="about">
            <div class="pic1"></div>
            <div class="text">
                <h2>About Me</h2>
                <pre>I am a passionate BSc CSIT student currently in 
my 7th semester. I love coding, web development,
and learning new technologies.</pre>
            </div>

        </div>
    </section>
    <!-- end of about me  -->

    <!-- myskills and education -->
    <section id="skills">
  <button id="prev">◀</button>
  <div class="skills" id="contentArea">
    <ul id="lts">
      <h2 id="text1">Skills</h2>
      <li id="text2">HTML, CSS, JavaScript</li>
      <li>PHP, MySQL</li>
      <li>Java, C++</li>
      <li>React (basic), Git</li>
    </ul>
    <img src="image/1.png" alt="skill" class="pic8" id="mainImage">
  </div>
  <button id="next">▶</button>
</section>


    <section id="projects">
        <h2>Projects</h2>
        <ul>
            <li>Hospital Management System (MERN Stack)</li>
            <li>Student Result Portal (PHP + MySQL)</li>
            <li>Portfolio Website (This one!)</li>
        </ul>
    </section>

    <section id="contact">
        <div id="contacts">
            <div class="Con1">
        <h2>Contact Us</h2>
        <pre>Realize your dream with us</pre><br>
<a href="<?php echo $user["github"]?>" id="githubs"><i class="fab fa-github gitss" ></i></a>
<a href="<?php echo $user["linkedin"]?>>"><i class="fa-brands fa-linkedin gitss"></i></a>
    </div>

    
        <form action="/../collab-training/send.php" method="POST" id="contactForm">
            <input type="text" placeholder="Name" name="name" required>
            <input type="email" placeholder="Your Email" name="mail" required>
            <input type="tel" name="pno" id="pno" placeholder="Your Number" required>
            <textarea placeholder="Your Message" name="message" required></textarea>
            <button type="submit" id="sub">Send Message</button>
            <p id="msg"></p>
        </form>
        </div>
    </section>
    <footer>
        <p>&copy; 2025 Ajay Bhayadyo</p>
    </footer>

    <script src="/../collab-training/public/portfolio/script.js"></script>
</body>
