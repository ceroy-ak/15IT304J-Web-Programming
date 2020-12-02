/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package jobtasker;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

class dbCheck {
    static Boolean login(String email, String password) throws ClassNotFoundException, SQLException{
          Class.forName("com.mysql.cj.jdbc.Driver");
          Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/mysql?zeroDateTimeBehavior=convertToNull&autoReconnect=true&useSSL=false", "root", "root");
          PreparedStatement ps = con.prepareStatement("select * from jobtasker.user where email=? and password=?");
          ps.setString(1, email);
          ps.setString(2, password);
          ResultSet rs = ps.executeQuery();
          Boolean result = rs.next();
          return result;
    }   
}
public class loginmain extends HttpServlet {

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        String email = request.getParameter("email");
        String password = request.getParameter("password");
        System.out.println("Login Requested");
        PrintWriter out = response.getWriter();
        Boolean success;
        try {
            success = dbCheck.login(email, password);
            System.out.println("Login complete " + success);
            if(success){
            Cookie ck = new Cookie("jobtasker_user", email);
            response.addCookie(ck);
            response.sendRedirect("home.jsp");
        }
        else{
            out.println("Login Failed");
            response.sendRedirect("login.html");
        }
        } catch (ClassNotFoundException ex) {
            Logger.getLogger(loginmain.class.getName()).log(Level.SEVERE, null, ex);
            System.out.println(ex);
            response.sendRedirect("index.html");
        } catch (SQLException ex) {
            Logger.getLogger(loginmain.class.getName()).log(Level.SEVERE, null, ex);
            System.out.println(ex);
            response.sendRedirect("index.html");
        }
        
    }

}
