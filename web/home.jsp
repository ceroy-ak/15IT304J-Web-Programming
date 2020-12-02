<%-- 
    Document   : home
    Created on : Oct 23, 2020, 1:22:46 PM
    Author     : abhis
--%>

<%@page import="java.util.Base64"%>
<%@page import="java.io.OutputStream"%>
<%@page import="java.sql.Blob"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.Connection"%>
<%@page import="java.sql.PreparedStatement"%>
<%@page import="java.sql.DriverManager"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
        <link rel="manifest" href="favicon/site.webmanifest">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Home </title>
        <style>
            img.center {
                display: block;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <button class="btn btn-danger" style="float:right; margin: 5px; padding: 1em" onclick="myFunction()">Logout</button>
        <%
            String email = null;
            String name = null;
            String base64 = null;
            Cookie[] ck = request.getCookies();
            for (Cookie c : ck) {
                if (c.getName().equals("jobtasker_user")) {
                    email = c.getValue();
                    break;
                }
            }
            if (email == null || email == "") {
                response.sendRedirect("index.html");
            } else {
                Connection con = null;
                Class.forName("com.mysql.cj.jdbc.Driver");
                con = DriverManager.getConnection("jdbc:mysql://localhost:3306/mysql?zeroDateTimeBehavior=convertToNull&autoReconnect=true&useSSL=false", "root", "root");
                String query = "Select * from jobtasker.user where email=?";
                PreparedStatement ps = con.prepareStatement(query);
                ps.setString(1, email);
                ResultSet rs = ps.executeQuery();
                rs.next();
                name = rs.getString("name");
                byte[] img = rs.getBytes("dp");
                base64 = Base64.getEncoder().encodeToString(img);
            }
        %>
        <br>
        <br>
        <br>
        <br>
        <br>
        <img src="data:image/jpeg;base64,<%=base64%>" height="200" width="180" class="center"/>
        <br>
        <br>
        <h1 align="center">Welcome, <%=name%> !!</h1>
        <br>
        <br>
        <div class="row">
            <div class="col-4"> </div>
            <div class="col-2"> 
                <a class="btn btn-success" target="_blank" href="http://localhost/records_php/records.php" style="padding-left: 2em; padding-right:2em; padding-top:1em; padding-bottom:1em"> Job Records </a>
            </div>
            <div class="col-1"> </div>
            <div class="col-1"> 
                <a class="btn btn-success" href="http://localhost/records_php/blogs.php?name=<%=name%>" style="padding-left: 2em; padding-right:2em; padding-top:1em; padding-bottom:1em"> Blogs </a>
            </div>
            <div class="col-4"> </div>

        </div>


        <script>
            function myFunction() {
                console.log("Called");
                var date = new Date();
                date.setDate(date.getDate() - 1);
                document.cookie = "jobtasker_user=; Expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;";
                location.reload();
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

   
    <%-- start web service invocation --%><hr/>
    <%
    try {
	quotes_package.NewWebService_Service service = new quotes_package.NewWebService_Service();
	quotes_package.NewWebService port = service.getNewWebServicePort();

	// TODO process result here
	java.lang.String result = port.quotes(name);
	out.println("<center>"+result+"</center>");
    } catch (Exception ex) {
	// TODO handle custom exceptions here
    }
    %>
    <%-- end web service invocation --%><hr/>
    </body>

</html>
