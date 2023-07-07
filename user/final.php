




<!DOCTYPE html>
<html>
<head>
    <title>Read Files</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism.min.css" />
    <link rel="stylesheet" href="assets/css/prism-dark.css" />


</head>


<body>

<style>


@import url('https://fonts.googleapis.com/css?family=Work+Sans');
        
        * {
             padding: 0;
             margin: 0;
           }
           
           body {
               background-color: black;
                 font-family: 'Work Sans', sans-serif;
             color: #f8f8f2;
               }
               
               pre {
             background-color: black !important;
             color: #f8f8f2 !important;
             font-size: 14px;
             padding: 20px;box-shadow: 0px 1px 11px 2px rgba(98,255,5,0.73);
             border-radius:5px;
             max-width:100%;
             min-height: 20vh !important;
             overflow-x: auto;
             -webkit-font-smoothing: antialiased;
             -moz-osx-font-smoothing: grayscale;
           }
         
       pre[class*="language-"].line-numbers {
       position: relative;
       padding-left: 3.8em;
       counter-reset: linenumber;
   }
   
           pre[class*="language-"].line-numbers > code {
               position: relative;
               white-space: inherit;
           }
   
       .line-numbers .line-numbers-rows {
           position: absolute;
           pointer-events: none;
           top: 0;
           font-size: 100%;
           left: -3.8em;
           width: 3em; /* works for line-numbers below 1000 lines */
           letter-spacing: -1px;
           border-right: 1px solid #999;
   
           -webkit-user-select: none;
           -moz-user-select: none;
           -ms-user-select: none;
           user-select: none;
   
       }
   
       .line-numbers-rows > span {
           display: block;
           counter-increment: linenumber;
       }
   
           .line-numbers-rows > span:before {
               content: counter(linenumber);
               color: #999;
               display: block;
               padding-right: 0.8em;
               text-align: right;
           }
   code{
     font-size:14px;
     background:transparent !important;
   }


   ::-webkit-scrollbar {
    width: 8px;
    height: 8px;
  }
  
  ::-webkit-scrollbar-thumb {
    background-color: #04e213 !important;
    border-radius: 8px !important;
  }
  
  ::-webkit-scrollbar-thumb:hover {
    background-color: #05820d !important;
  }
  
  ::-webkit-scrollbar-track {
    background-color: #f5f5f5 !important;
    border-radius: 8px;
  }


    </style>


<?php

require '../config.php';


$level = $_GET['level'];
$id = $_GET['cat_id'];
if ($level == "level1"){
    $sql = "SELECT * FROM file where cat_id=".$id." ORDER BY id  LIMIT 10";
}
elseif ($level == "level2"){
    $sql = "SELECT * FROM file where sub_id=".$id." ORDER BY id   LIMIT 10";
}
elseif ($level == "level3"){
    $sql = "SELECT * FROM file where child_id=".$id." ORDER BY id   LIMIT 10";

}
$result = $conn->query($sql);
$content = array();
$filenamess = array();
$fileext = array();
$parent = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo ' <textarea style="display:none" class="contents">'.$row['filename']."\n\n\n". $row['contents'].'</textarea>';
    }
}
else{
  echo ' <textarea style="display:none" class="contents">No Files Found</textarea>';
  
}
    ?>
    <pre style="margin:100px;"><code ></code></pre>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/line-numbers/prism-line-numbers.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.10/typed.min.js" integrity="sha512-hIlMpy2enepx9maXZF1gn0hsvPLerXoLHdb095CmRY5HG3bZfN7XPBZ14g+TUDH1aGgfLyPHmY9/zuU53smuMw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/prism.js"  ></script>
    <script>

var textareas = document.querySelectorAll('.contents');
var a = [];
for (var i = 0; i < textareas.length; i++) {
  var content = textareas[i].innerHTML;
  a.push(content);
}
console.log(a)
        
var options = {
  strings: a,
  typeSpeed: 20,
  showCursor: false,
  onComplete: function(self) {
    var currentCode = self.el;
    Prism.highlightElement(currentCode);
    var nextCode = currentCode.nextElementSibling;
    if (nextCode) {
      setTimeout(function() {
        var typed = new Typed(nextCode, options);
      }, 5000); }
  }
};



        var codeElements = document.querySelectorAll('code');
        var firstCode = codeElements[0];
        var firstTyped = new Typed(firstCode, options);











</script>
</body>
</html>
