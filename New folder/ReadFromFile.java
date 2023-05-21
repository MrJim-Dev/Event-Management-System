import java.io.*;
import java.util.*;

public class ReadFromFile {
    

    public static void main(String []args) throws IOException{
        BufferedReader br = new BufferedReader(new FileReader("MyFile.txt"));
        String str = br.readLine();

        StringTokenizer st = new StringTokenizer(str, ","); //
        while (st.hasMoreTokens()) {
            System.out.println(Math.pow(Integer.parseInt(st.nextToken()), 3));
        }

        Scanner scan = new Scanner(System.in);


        int y = scan.nextChar()
    }

}
