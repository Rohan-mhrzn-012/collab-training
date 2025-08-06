document.getElementById("contactForm").addEventListener("submit"
    , function(e) {
    document.getElementById("msg").textContent = "Message sent!";
    document.getElementById("msg").style.color = "green";
});

  const nextBtn = document.getElementById("next");
  const title = document.getElementById("text1");
  const list = document.getElementById("lts");
  const img = document.getElementById("mainImage");
  const prev = document.getElementById("prev");

  nextBtn.addEventListener("click", function () {
    prev.textContent = "◀";
    title.textContent = "Education";

 
    list.innerHTML = `
      <h2 id="text1">Education</h2>
      <li>BSc CSIT - TU</li>
      <li>+2 Science - BASU</li>
      <li>SEE - NEB</li>
    `;

    img.src = "image/2.png";
    img.alt = "education";
  });

  prev.addEventListener("click",
    function(){
      nextBtn.textContent = "▶";
       list.innerHTML = `
      <h2 id="text1">Skills</h2>
      <li id="text2">HTML, CSS, JavaScript</li>
      <li>PHP, MySQL</li>
      <li>Java, C++</li>
      <li>React (basic), Git</li>
   `;
      img.src = "image/1.png";
    img.alt = "education";
    }
  );
