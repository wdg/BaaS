//
//  SecondViewController.swift
//  Demo Application
//
//  Created by Wesley de Groot on 23/11/2018.
//  Copyright © 2018 Wesley de Groot. All rights reserved.
//

import UIKit
import BaaS
class SecondViewController: UIViewController {
    /// BaaS Shared
    let database = BaaS.shared
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        
        //        database.delegate = self
        database.set(server: "http://127.0.0.1:8000/index.php")
        database.set(apiKey: "DEVELOPMENT_UNSAFE_KEY")
        
        // Save our file name
        let fileName = "thisIsMyFileName"
        
        // Empty file
        var fileData: Data?
        
        // Does our file exists
        if database.fileExists(withFileID: fileName) {
            // Yup, load it.
            database.log(
                String.init(
                    data: database.fileDownload(withFileID: fileName),
                    encoding: .utf8
                )!
            )
            
            // and Delete it
            database.fileDelete(withFileID: fileName)
        } else {
            // Set our file contents
            //            fileData = UIImage(named: "mylocalimagename")?.pngData()
            fileData = "This is our fake data string for testing" . data(using: .utf8)
            
            // Check if we got real data.
            guard let fileData = fileData else {
                return
            }
            
            // Upload it
            database.log(
                database.fileUpload(
                    data: fileData,
                    saveWithFileID: fileName
                )
            )
            
            super.viewDidLoad()
            // Do any additional setup after loading the view, typically from a nib.
        }
    }
    
}
