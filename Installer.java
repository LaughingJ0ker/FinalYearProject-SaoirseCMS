package installer;
import java.awt.Container;
import java.awt.Desktop;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;

import org.apache.commons.net.ftp.FTP;
import org.apache.commons.net.ftp.FTPClient;
import org.apache.commons.net.imap.IMAPClient.FETCH_ITEM_NAMES;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.net.*;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextArea;
import javax.swing.JTextField;

public class Installer extends JFrame{

	private static JTextArea extractOutput = new JTextArea("Installation...",15,60);
	private static final long serialVersionUID = 1L;
	private static String destinationname;
	
	JTextField usernameInput, passwordInput,portInput, serAddInput, activeDirInput;


	public Installer(){
		JPanel panel = new JPanel();

		/*
		panel.add(new JLabel("Installation"), BorderLayout.WEST);

		extractOutput = new JTextArea("Installing...\n", 15,60);
		extractOutput.setEditable(false);
		extractOutput.setCaretPosition(extractOutput.getText().length()-1);

		JScrollPane sp = new JScrollPane(extractOutput);


		panel.add(sp);
		 */

		//setContentPane(panel1WelcomeScreen());
		
	     Font f = new Font("SansSerif", Font.ITALIC | Font.BOLD, 14);
	     
	     
		Container pane = getContentPane();
		JButton button;
	    pane.setLayout(new GridBagLayout());
	    GridBagConstraints c = new GridBagConstraints();
	      // natural height, maximum width
	      c.fill = GridBagConstraints.HORIZONTAL;

	    JLabel title = new JLabel("SaoirseCMS Installation");
	    title.setFont(f);
	    c.gridwidth = 2; // 2 columns wide
	    c.weightx = 0.5;
	    c.gridx = 0;
	    c.gridy = 0;
	    c.insets = new Insets(0, 10, 4, 10); // top padding
	    pane.add(title, c);  
	      
	    JLabel username = new JLabel("FTP username:");
	    c.gridwidth = 1; // 2 columns wide
	    c.weightx = 0.5;
	    c.gridx = 0;
	    c.gridy = 1;
	    c.insets = new Insets(0, 10, 10, 10); // top padding
	    pane.add(username, c);

	    JLabel password = new JLabel("FTP password:");
	    c.gridx = 0;
	    c.gridy = 2;
	    pane.add(password, c);

	    JLabel ftpport = new JLabel("FTP port:");
	    c.gridx = 0;
	    c.gridy = 3;
	    pane.add(ftpport, c);
	    
	    JLabel ftpadd = new JLabel("FTP Server Address:");
	    c.gridx = 0;
	    c.gridy = 4;
	    pane.add(ftpadd, c);
	    
	    JLabel ftpdir = new JLabel("Server Root Directory:");
	    c.gridx = 0;
	    c.gridy = 5;
	    pane.add(ftpdir, c);

	    usernameInput = new JTextField("");
	    //c.gridwidth = 3;
	    c.gridx = 1;
	    c.gridy = 1;
	    pane.add(usernameInput, c);

	    passwordInput = new JTextField("");
	    //c.gridwidth = 3;
	    c.gridx = 1;
	    c.gridy = 2;
	    pane.add(passwordInput, c);
	    
	    portInput = new JTextField("21");
	    //c.gridwidth = 3;
	    c.gridx = 1;
	    c.gridy = 3;
	    pane.add(portInput, c);
	    
	    serAddInput = new JTextField("");
	    //c.gridwidth = 3;
	    c.gridx = 1;
	    c.gridy = 4;
	    pane.add(serAddInput, c);
	    
	    activeDirInput = new JTextField("");
	    //c.gridwidth = 3;
	    c.gridx = 1;
	    c.gridy = 5;
	    pane.add(activeDirInput, c);
	
	    
	    button = new JButton("Exit");
	    c.ipady = 1; // reset to default
	    c.ipadx = 55;
	    c.weighty = 0.5; // request any extra vertical space
	    c.anchor = GridBagConstraints.PAGE_END; // bottom of space
	    c.gridx = 0; // aligned with button 2
	    c.gridy = 7; // third row
	    c.insets = new Insets(10, 10, 10, 10);
	    button.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent arg0) {
				System.exit(0);
			}
		});
	    pane.add(button, c);
	    
	    
	    JButton strIns = new JButton("Start Installation");
	    //c.ipady = 1; // reset to default
	   // c.ipadx = 55;
	    c.weighty = 0.5; // request any extra vertical space
	    c.anchor = GridBagConstraints.PAGE_END; // bottom of space
	    c.gridx = 1; // aligned with button 2
	    c.gridwidth = 2; // 2 columns wide
	    c.gridy = 7; // third row
	    c.insets = new Insets(10, 10, 10, 10); 
	    strIns.addActionListener(new ActionListener() {
			@Override
			public void actionPerformed(ActionEvent arg0) {
				if(usernameInput.getText().isEmpty() || passwordInput.getText().isEmpty() || portInput.getText().isEmpty() || serAddInput.getText().isEmpty() || activeDirInput.getText().isEmpty()){
					JOptionPane.showMessageDialog(null, "Error. No field can be left blank. Please try again.");			
				}
				else{
					parseDetails();
				}
			}
		});
	    pane.add(strIns, c);
	  


		setSize(400,260);
		setLocationRelativeTo(null);
		setVisible(true);
	}

	public static void main(String [] args){

		Installer buildGUI = new Installer();
		buildGUI.setDefaultCloseOperation(EXIT_ON_CLOSE);

		//test();


	}

	public void parseDetails(){
		
		
		String un,passwd,port,seradd,serdir;
		
		un = usernameInput.getText();
		passwd = passwordInput.getText();
		port = portInput.getText();
		seradd = serAddInput.getText();
		serdir = activeDirInput.getText();
		
		System.out.println(un);
		System.out.println(passwd);
		System.out.println(port);
		System.out.println(seradd);
		System.out.println(serdir);
		
		//test(un,passwd,port,seradd,serdir);
		
	}
	
	//open an ftp connection, and upload a zip file and extract php script to extract zip
	//Also involves changing working directory and send chmod commands to the server.
	public static void test(String un, String pswd, String port, String seradd, String serdir) {
		// TODO Auto-generated method stub
		int portInt = Integer.parseInt(port);
		FTPClient client = new FTPClient();
		FileInputStream fis = null;
		FileInputStream fis1 = null;
		String host= seradd, dir= serdir;
		try {	
			client.connect(host, portInt);
			client.login(un, pswd);
			client.changeWorkingDirectory(dir);
			String di = "saoirse";
			
			client.setFileType(FTP.BINARY_FILE_TYPE);
			
			if(client.makeDirectory(di)){
				System.out.println("Directory \""+di+"\" created!");
			}else{
				System.out.println("Error creating directory. This may be because of a file permission issue. Please restart installer. If it contines to fail, please contact your hosting provider and  insturct them you cann create directories.");
				System.exit(0);
			}
				
			/*
			if(client.sendSiteCommand("CHMOD 0777 "+di)){
				System.out.println("yes!!");
			}else{
				System.out.println("no");
			}
			*/
			
			// Create an InputStream of the files to be uploaded
			String filenamezip = "saoirse.zip";
			String filenameext = "extract.php";

			//Just confirm ZIP exists
			File fZip = new File(filenamezip);
			if(fZip.exists())
				System.out.println("Starting upload...zip");
			
			//Just confirm extract php file exists
			File fExt = new File(filenameext);
			if(fExt.exists())
				System.out.println("Starting upload...extract");

			//Create file input streams for ZIP and extract.php
			fis = new FileInputStream(fZip);	
			fis1 = new FileInputStream(fExt);	    	

			//Change working directory to di
			client.changeWorkingDirectory(di);
					
			// Store file to server
			if(client.storeFile(filenameext, fis1)){
				System.out.println("uploaded extract");
			}else{
				System.out.println("error");
			}
			

			
			/*
			//upload zip
			//if(client.storeFile(filenamezip, fis)){
			System.out.println("uploaded zip");
			//}else{
				System.out.println("error");
			//}*/
			
			//Change to directory "saoirse" and change it file permissions of Frontend to 777 so php has permission to create files (755 might work)
			//client.changeWorkingDirectory("saoirse");
			//client.sendSiteCommand("CHMOD 0777 Frontend");
			
			
			//client.changeWorkingDirectory("../");
			//client.sendSiteCommand("CHMOD 0755 "+di);	
			
			//change working directory to cms folder (saoirse), and chmod all folder to 0755 apart from 
			//public php folder

			client.logout();
			host = "http://d1272558-27752.cp.blacknight.com/"+filenameext;
			//openInstall(host);
	
		} catch (IOException e) {
			e.printStackTrace();
		} finally {
			try {
				if (fis != null) {
					fis.close();
				}
				client.disconnect();
			} catch (IOException e) {
				e.printStackTrace();
			}
		}
	
	}
	
	/*
	 * A method to open the installation page when installation finishes.
	 * 
	 * @param URL, the URL to be opened by browser.
	 */
	public static void openInstall(String URL){

		System.out.print(URL);

		//Create Desktop object
		Desktop d=Desktop.getDesktop();

		//Browse a URL
		try {
			d.browse(new URI(URL));
		} catch (IOException e) {
			e.printStackTrace();
		} catch (URISyntaxException e) {
			e.printStackTrace();
		}
	}
}
