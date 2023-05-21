import java.io.*;

public class WriteToFile {
    

    public static void main(String []args) throws IOException {
BufferedWriter bw = new BufferedWriter(new FileWriter("myFile.txt"));

String str[] = {"3", "5", "7"};
for (int i = 0; i < str.length; i++) {
bw.write(str[i].concat(","));
}
System.out.println("Successfully written to file");
bw.close();
    }
}
