import java.io.*;

public class CreateFile {
    

    public static void main(String []args) throws IOException {
        File dir = new File("folder");
        dir.mkdir();

        File file = new File(dir, "file.txt");

        if (!file.exists()) {
            file.createNewFile();
            System.out.println("File successfully created!");
            System.out.println("Absolute Path: " + file.getAbsolutePath()); 
            System.out.println("Filename: " + file.getName());
            System.out.println("Parent DIR: " + file.getParent());
        } else {
            System.out.println("File already existed!");
            System.out.println("Absolute Path: " + file.getAbsolutePath()); 
            System.out.println("Filename: " + file.getName());
            System.out.println("Parent DIR: " + file.getParent());
        }
    }
}
