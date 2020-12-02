function loadXML() 
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    present(this);
    }
  };
  xhttp.open("GET", "blogs.xml", true);
  xhttp.send();
}

function present(data)
{
    $("#blogs").empty();
  xml = data.responseXML;
  blogs = xml.getElementsByTagName("blog");
  for(i=0; i<blogs.length; i++)
  {
    var title = blogs[i].childNodes[0].innerHTML;
    var author = blogs[i].childNodes[1].innerHTML;
    var date = blogs[i].childNodes[2].innerHTML;
    var body = blogs[i].childNodes[3].innerHTML;

    //$('#blogs').html("<b>Hello world!</b>");

    
   var element =  `<div class='card bg-light' style='width: 36rem;margin:auto; margin-bottom:2rem;'>
 <div class='card-body' style='margin:4.5em'>
   <h3 class='card-title'>`+title+`</h3>
   <h6 class='card-subtitle text-muted'>`+author+`</h6>
   <h6 class='card-subtitle text-muted' style='text-align: right;'>`+date+`</h6>
   <hr>
   <div class='card-text'>`+body+`</div>
 </div>
</div>`;
    $("#blogs").append(element);
    
  }
}