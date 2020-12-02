/*
 * Here comes the text of your license
 * Each line should be prefixed with  * 
 */
package jobtasker;

import java.util.Random;
import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;

/**
 *
 * @author abhis
 */
@WebService(serviceName = "Quotes")
public class Quotes {

    /**
     * This is a sample web service operation
     */
    @WebMethod(operationName = "quotes")
    public String quotes(@WebParam(name = "name") String name) {
        String[] arr = {
        "Whatever the mind of man can conceive and believe, it can achieve. –Napoleon Hill",
        "Strive not to be a success, but rather to be of value. –Albert Einstein",
        "You miss 100% of the shots you don’t take. –Wayne Gretzky",
        "The most difficult thing is the decision to act, the rest is merely tenacity. –Amelia Earhart",
        "Every strike brings me closer to the next home run. –Babe Ruth",
        "Definiteness of purpose is the starting point of all achievement. –W. Clement Stone",
        "Life is what happens to you while you’re busy making other plans. –John Lennon",
        "Life is 10% what happens to me and 90% of how I react to it. –Charles Swindoll",
        "The mind is everything. What you think you become.  –Buddha",
        "Eighty percent of success is showing up. –Woody Allen",
        "I am not a product of my circumstances. I am a product of my decisions. –Stephen Covey",
        "You can never cross the ocean until you have the courage to lose sight of the shore. –Christopher Columbus",
        "Whether you think you can or you think you can’t, you’re right. –Henry Ford",
        "Whatever you can do, or dream you can, begin it.  Boldness has genius, power and magic in it. –Johann Wolfgang von Goethe"
        };
        
        String s = "Hi " + name + ", todays quote is '" + arr[new Random().nextInt(arr.length)]+"'";
        return s;
    }
}
