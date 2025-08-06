<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/core_php/collab-training/public/portfolio/css/portfolio_css.css">
    
    <style>
        
      
    </style>
</head>
<body>
            <div class="nav_wrapper">
                <div id="nav_name">
                    <h1>Pradeep Manandhar</h1>
                </div>
                <div class="nav_container">
                    <div id="item1" class="items"><a href="#home">Home</a></div>
                    <div id="item2" class="items"><a href="#about">About</a></div>
                    <div id="item3" class="items"><a href="#nav_name">Portfolio</a></div>
                </div>
                <!-- <i class="fa-solid fa-phone"></i>  -->
                 <div class="items contact_div"  id="item4"><a href="#contact">📞Contact</a></div>
            </div>
            <div class="content" id="home">
                <div id="img_div">
                    <img src="/core_php/collab-training/public/portfolio/images/me.JPG" alt="my_img" id="my_img">
                </div>
                <div class="paragraph">
                    <p>
                        <h1>Pradeep Manandhar</h1>
                <pre>
                He is 
                Just A Kid From Bhaktapur
                </pre>
                        Introduce, his name is Pradeep Manandhar,
                        Currently he is studying at Bhaktapur Multiple Campus. He was born on October 2002. He is a <a href="" id="color">web developer</a>.                        
                    </p>
                    <!-- <div class="links1"><button type="click" id="linked"><i class="fa-brands fa-linkedin"></i> Pradeep Manandhar</button>
                    <button type="click" id="github"><i class="fa-brands fa-github"></i> Pradeep Manandhar</button></div> -->
                        
                    <div class="links2"><a href="https://github.com/pradeep-manandhar" id="github1"><i class="fa-brands fa-github"></i> Pradeep Manandhar</a>
                    <a href="https://www.linkedin.com/in/pradeep-manandhar-a90855248/" id="linked1"><i class="fa-brands fa-linkedin"></i> Pradeep Manandhar</a></div>
                    
                </div>
                
                
            </div>
            <div id="skill_div">
                <div id="about">
                    <h2>Skills</h2>
                    <ul>
                        <li>Programming Languages</li>
                            <ul>
                                <li>C</li>
                                <li>C++</li>
                                <li>HTML</li>
                                <li>CSS</li>
                                <li>JavaScript</li>
                            </ul>
                        <li>Tools</li>
                        <ul>
                            <li>Visual Studio Code</li>
                            <li>Git</li>
                            <li>GitHub</li>
                        </ul>
                    </ul>
                </div>
            </div> 

            <div id="exp_div">
                <h2>Experience</h2>
                <ul>
                    <li>Laravel Intern</li>
                </ul>
            </div>
            <div id="contact_div" >
                <div id="contact">
                    <h2>Contact Me</h2>
                    <ul><li>E-mail : sayamipradeep5@gmail.com</li></ul>
                    <form action="#" method="post">
                        <fieldset>
                            <legend>Want to get in contact with me???</legend>
                                                       
                            
                            <div id="message_div">
                                <div id="fname_div" class="mb-3">
                                <label for="FirstName">First Name:</label><br>
                                <input type="text" placeholder="Enter your first name" name="fname">
                                
                                </div>
                                <div id="lname_div">
                                <label for="LastName">Last Name:</label><br>
                                <input type="text" placeholder="Enter your last name" name="lname">
                                </div> 

                            <div id="email_div">
                                <label for="email">E-mail</label><br>
                                <input type="email" id="email" name="email" placeholder="Enter your mail address">
                            </div>
                            <div id="mobile_div">
                                <label for="Mobile Number">Mobile Number:</label><br>                          
                                <input type="number" placeholder="Enter mobile number" name="mobile" id="mobile"><br>
                            </div>
                            <div id="message">
                                <label for="message">Type your message:</label><br>
                                <textarea name="message" id="message" cols="30" rows="5" placeholder="Type your message here..."></textarea>
                            </div>                                                                             
                                  <button id="submit">Submit</button>   
                            </div>                      
                            
                            
                            
                        </fieldset>
                    </form>
                </div>
            </div>   
</body>
</html>