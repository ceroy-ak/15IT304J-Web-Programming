/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package jobtasker;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.time.LocalDate;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.MultipartConfig;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.Part;


@MultipartConfig(maxFileSize = 161772150) 
public class registration extends HttpServlet {
    
    private String dbURL = "";
    private String dbUser = "root";
    private String dbPass = "root";
    
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        //Name
        String name = request.getParameter("name");
        
        //Email
        String email = request.getParameter("email");
        
        //Password
        String password= request.getParameter("Password");
        
        //LinkedIn
        String linkedInURL = request.getParameter("linkedIn");
        
        //Date of Birth
        String dob = request.getParameter("dob");
        
        //Address
        String address = request.getParameter("add");
        
        //Pincode
        int pincode = Integer.parseInt(request.getParameter("pincode"));
        
        //Mobile
        String mob = request.getParameter("mob");
        
        //FavColor
        String favColor = request.getParameter("color");
        
        //Gender
        String gender = request.getParameter("gender");
        
        //Platform
        String platform = request.getParameter("platform");
        
        //Profile Image
        InputStream inputStream = null;
        Part filePart = request.getPart("photo");
        if (filePart != null && filePart.getSize() != 0) {
            inputStream = filePart.getInputStream();
            System.out.println(filePart.getSize());
        }else{
            inputStream = new FileInputStream(new File(getServletContext().getRealPath("default_pic.png")));
        }
        
        Connection con = null;
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            con = DriverManager.getConnection("jdbc:mysql://localhost:3306/mysql?zeroDateTimeBehavior=convertToNull&autoReconnect=true&useSSL=false", "root", "root");
            String query = "INSERT INTO jobtasker.user(email, password, name, linkedin, dob, address, pincode, mob, favcolor, gender,"
                    + "platform,dp) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            
            String query2 = "CREATE TABLE jobtasker.`"+email+"`(`id` INT NOT NULL AUTO_INCREMENT,`title` VARCHAR(300) NOT NULL," + 
	"`url` VARCHAR(1000),`jobDescription` TEXT,`applydate` DATE NOT NULL,`status` VARCHAR(100) NOT NULL,PRIMARY KEY (`id`), `company` VARCHAR(200) NOT NULL)";
            PreparedStatement ps = con.prepareStatement(query);
            ps.setString(1, email);
            ps.setString(2,password);
            ps.setString(3,name);
            ps.setString(4,linkedInURL);
            ps.setString(5, dob);
            ps.setString(6,address);
            ps.setInt(7, pincode);
            ps.setString(8, mob);
            ps.setString(9,favColor);
            ps.setString(10,gender);
            ps.setString(11,platform);
            ps.setBlob(12,inputStream);
            int row = ps.executeUpdate();
            if(row!=0){
                PreparedStatement ps2 = con.prepareStatement(query2);
                System.out.print("Creation of table status: " + ps2.execute());
                response.sendRedirect("login.html");
            }
            else{
                response.sendRedirect("register.html");
            }
            
        } catch (ClassNotFoundException | SQLException ex) {
            Logger.getLogger(registration.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            if (con != null) {
                // closes the database connection
                try {
                    con.close();
                } catch (SQLException ex) {
                    System.out.print(ex);
                }
                }
            }
    }
}
        
