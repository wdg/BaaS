<?php
/**
 * Set the namespace to 'BaaS'
 */
namespace BaaS;

/**
 * Class 'Server'
 * Backend as a Service Server (BaaS Server)
 *
 * @version 1.0
 * @copyright Wesley de Groot (https://wesleydegroot.nl), et al.
 * @link https://github.com/wdg/BaaS
 * @url https://github.com/wdg/BaaS
 * @package BaaS
 */
class Server {
	/**
	 * BaaS version
	 *
	 * This one will never be exposed to the outside world.
	 *
	 * @since 1.0
	 * @var string $version BaaS Version number
	 */
	private $version = "1.0";

	/**
	 * BaaS build
	 *
	 * This one will never be exposed to the outside world.
	 *
	 * @since 1.0
	 * @var string $build BaaS build number
	 */
	private $build = "20190808";

	/**
	 * Set API Version
	 *
	 * The API Version which we'll use to connect to.
	 *
	 * @since 1.0
	 * @var string $APIVer API Version
	 */
	private $APIVer = "1.0";

	/**
	 * Debugmode
	 *
	 * @since 1.0
	 * @var bool $debugmode set debug mode
	 */
	private $debugmode = false;

	/**
	 * email address
	 *
	 * @since 1.0
	 * @var bool $emailAddress set email address
	 */
	private $emailAddress = "BaaS@wdg.codes";

	/**
	 * BaaS address
	 *
	 * @since 1.0
	 * @var bool $BaaSAddress set email address
	 */
	private $BaaSAddress = "INIT";

	/**
	 * Time befor resetting the maximum retries
	 *
	 * @since 1.0
	 * @var string $sessionTime time to reset session token
	 */
	private $sessionTime = "+1 month";

	/**
	 * Bind Session to IP?
	 *
	 * @since 1.0
	 * @var bool $bindSessionToIP Bind Session to IP?
	 */
	private $bindSessionToIP = false;

	/**
	 * Automatic translation
	 *
	 * @since 1.0
	 * @var bool $translate set automatic translation on(auto)/off
	 */
	private $translate = true;

	/**
	 * API Key
	 *
	 * @since 1.0
	 * @var string $APIKey the API key
	 */
	private $APIKey = "invalid";

	/**
	 * Maximum retries
	 *
	 * @since 1.0
	 * @var integer $triesMaximum maximum tries
	 */
	private $triesMaximum = 3;

	/**
	 * Time befor resetting the maximum retries
	 *
	 * @since 1.0
	 * @var string $triesTime time to reset maximum tries
	 */
	private $triesTime = "+24 hours";

	/**
	 * Save file location.
	 *
	 * @since 1.0
	 * @var string $BFfile File location
	 */
	private $BFfile = "Data/BFlog/%s.txt";

	/**
	 * Save file directory.
	 *
	 * @since 1.0
	 * @var string $blockFilePath Directory location
	 */
	private $blockFilePath = "Data/BFlog/";

	/**
	 * is current user an Admin?
	 *
	 * @since 1.0
	 * @var bool $isAdmin is it a admin
	 */
	private $isAdmin = false;

	/**
	 * Are we running on a cli (command line interface)
	 *
	 * @since 1.0
	 * @var bool $isCLI is it a cli?
	 */
	private $isCLI = (PHP_SAPI === 'cli');

	/**
	 * Is there a error
	 *
	 * @since 1.0
	 * @var bool $error is there a error
	 */
	private $error = false;

	/**
	 * What is the error message
	 *
	 * @since 1.0
	 * @var string $errorMessage error message
	 */
	private $errorMessage = "";

	/**
	 * Save files to database?
	 *
	 * @since 1.0
	 * @var string $saveFilesToDatabase Save files to the database?
	 */
	private $saveFilesToDatabase = false;

	/**
	 * Database Configuration
	 *
	 * @since 1.0
	 * @var mixed $database database configuration
	 */
	private $dbConfig = array(
		// Database Path
		'path' => 'Data/database.sqlite',

		// Database Type
		'type' => '',

		// Database Name
		'name' => '',

		// Database Username
		'user' => '',

		// Database Password
		'pass' => '',
	);

	/**
	 * HTTP Protocol
	 *
	 * @since 1.0
	 * @var string $protocol The protocol
	 */
	private $protocol = 'HTTP/1.1';

	/**
	 * return HTTP codes
	 *
	 * @since 1.0
	 * @var string|array $errorCode Return this error codes
	 */
	private $errorCode = array(
		// HTTP 406 = Not Acceptable
		'blocked' => 406,

		// HTTP 501 = Not Implemented
		'invalidRequest' => 501,

		// HTTP 200 = OK
		'ok' => 200,
	);

	/**
	 * Defaults fields
	 *
	 * The fields which may be missing on insertion
	 *
	 * @since 1.0
	 * @var string|array $errorCode Return this error codes
	 */
	private $defaultFields = array(
		// ID field
		"id",

		// Latitude field
		"latitude",

		// Longitude field
		"longitude",
	);

	/**
	 * Defaults tables
	 *
	 * The default tables for running BaaS
	 *
	 * @since 1.0
	 * @var string|array $defaultTables Default tables
	 */
	private $defaultTables = array(
		// User database name
		'users' => 'BaaS_UserDB',

		// File database name
		'files' => 'BaaS_FileDB',

		// Sessions database name
		'sessions' => 'BaaS_SessionDB',
	);

	/**
	 * Extensions
	 *
	 * We'll support extensions
	 *
	 * @since 1.0
	 * @var string|array $extensions Extensions array
	 */
	private $extensions = array();

	/**
	 * userRegistrationDisabled
	 *
	 * Is the user registration disabled?
	 *
	 * @since 1.0
	 * @var bool $extensions userRegistrationDisabled?
	 */
	private $userRegistrationDisabled = false;

	/**
	 * userLoginDisabled
	 *
	 * Is the user login disabled?
	 *
	 * @since 1.0
	 * @var bool $extensions userLoginDisabled?
	 */
	private $userLoginDisabled = false;

	/**
	 * Set database configuration
	 *
	 * @since 1.0
	 * @param string $type mysql/sqlite
	 * @param string $hostOrPath Host or Path name
	 * @param string $databaseName Database name
	 * @param string $username username
	 * @param string $password Password
	 * @return void
	 */
	public function setDatabase($type, $hostOrPath = '', $databaseName = '', $username = '', $password = '') {
		// Set error = no
		$this->error = false;

		// Error message empty
		$this->errorMessage = "";

		// Check database type
		switch (strtolower($type)) {
		// database type is SQLite
		case 'sqlite':
			// Set database type to SQLite
			$this->dbConfig['type'] = 'sqlite';

			// If host/path name is not empty
			if (!empty($hostOrPath)) {
				// Check if the path is writeable
				if (is_writable($hostOrPath) || touch($hostOrPath)) {
					// Set the path
					$this->dbConfig['path'] = $hostOrPath;
				} else {
					// Error
					$this->error = true;

					// Path is not writeable
					$this->errorMessage = sprintf(
						"Path \"%s\" is not writeable",

						// FilePath
						$hostOrPath
					);
				}
			}
			break;

		case 'mysql':
			// Set database type to MySQL
			$this->dbConfig['type'] = 'mysql';

			// Check if required information is not missing
			if (empty($hostOrPath)) {
				// Error
				$this->error = true;

				// Missing hostname and username!
				$this->errorMessage = "Missing hostname";
			}

			// Check if required information is not missing
			if (empty($username)) {
				// Error
				$this->error = true;

				// Missing hostname and username!
				$this->errorMessage = "Missing username";
			}

			// Check if required information is not missing
			if (empty($databaseName)) {
				// Error
				$this->error = true;

				// Missing hostname and username!
				$this->errorMessage = "Missing database name.";
			}

			// If not empty
			if (!empty($hostOrPath)) {
				// Set the database host
				$this->dbConfig['host'] = $hostOrPath;
			}

			// If not empty
			if (!empty($databaseName)) {
				// Set the database name
				$this->dbConfig['name'] = $databaseName;
			}

			// If not empty
			if (!empty($username)) {
				// Set the database username
				$this->dbConfig['user'] = $username;
			}

			// Set the database password
			$this->dbConfig['pass'] = $password;
			break;

		default:
			// Oops a error
			$this->error = false;

			// Set the error message
			$this->errorMessage = sprintf(
				"Database type %s does not exists",

				// Database Type.
				$type
			);
			break;
		}
	}

	/**
	 * Hash a password.
	 *
	 * @since 1.0
	 * @var string $password The password
	 */
	private function hashPassword($password) {
		return hash('sha512', $password);
	}

	/**
	 * attach Extension
	 *
	 * @since 1.0
	 * @param string $extensionURL Extension url (in regex)
	 * @param string $extensionCall extensionClass::myFunction
	 * @param bool $needsAPIKey Do we need a API Key to run this?
	 * @return mixed
	 */
	public function attachExtension($extensionURL, $extensionCall, $needsAPIKey = true) {
		// Check if the extension is callable
		if (is_callable($extensionCall)) {
			// Append to extensions
			$this->extensions[] = array(
				//Extension url (in regex)
				$extensionURL,

				//extensionClass::myFunction
				$extensionCall,

				// Needs API Key?
				$needsAPIKey,
			);
		} else {
			header("Content-type: application/json");

			// Show a error
			echo json_encode(
				// Array of errors
				array(
					// Warning
					"warning" => "Extension not callable",

					// Possible Fix
					"fix" => "Please check that the function exists, and is callable (not private)",

					// Extension
					"extension" => array(
						// URL
						"url" => $extensionURL,

						// Call
						"call" => $extensionCall,
					),
				)
			);

			// Exit
			// 0 means no error, since we'll want to output the error.
			exit($this->isCLI ? 1 : 0);
		}
	}

	/**
	 * Check API Key
	 *
	 * @since 1.0
	 * @internal
	 * @return bool
	 */
	protected function checkAPIKey() {
		// First check if the key is not invalid.
		if ($this->APIKey == "invalid") {
			// Return invalid key
			return false;
		}

		// Find a quick way to disable bruteforcing.
		if (file_exists($this->BFfile)) {
			// If the file contents > maximum tries
			if ((int) file_get_contents($this->BFfile) >= $this->triesMaximum) {
				// If current time > Max. Tries. time + File modified time
				if (time() > strtotime($this->triesTime, filemtime($this->BFfile))) {
					// Try to unlink the file
					@unlink($this->BFfile);
				} else {
					// Check if not in debug mode
					if (!$this->debugmode) {
						// Set HTTP Status code
						$this->setHTTPStatusCode($this->errorCode['blocked']);

						// Say wrong APIKey
						header("API-Key: Invalid");

						// blocked.
						echo (
							json_encode(
								array(
									// Send Status
									"status" => "Failed",

									// Send the warning message
									"warning" => "You are blocked from using this service.",

									// Send some details
									"details" => sprintf(
										// BaaS/...
										"BaaS/%s, Connection: Close, IP-Address: %s",

										// BaaS API Version
										$this->APIVer,

										// IP-Address
										$_SERVER['REMOTE_ADDR']
									),

									// Return the API Key
									"apiKey" => (
										// Does the APIKey exists?
										isset($_POST['APIKey'])

										// Use the POST
										 ? $_POST['APIKey']

										// Else
										 :
										(
											// If there is a APIKey?
											json_decode($_POST['JSON'])->APIKey

											// Show the JSON APIKey
											 ? json_decode($_POST['JSON'])->APIKey

											// No API Key
											 : 'None prodived'
										)
									),
								)
							)
						);

						// Exit
						// 0 means no error, since we'll want to output the error.
						exit($this->isCLI ? 1 : 0);

						// You're still blocked
						return false;
					}
				}
			}
		}

		// Check if the key is valid
		if (isset($_POST['APIKey'])) {
			// if POST APIKey equals APIKey
			if ($_POST['APIKey'] === $this->APIKey) {
				// APIKey is valid
				return true;
			}
		}

		// Check if the key is valid, the JSON way.
		if (isset($_POST['JSON'])) {
			// if POST JSON APIKey equals APIKey
			$JSON = json_decode($_POST['JSON']);
			if (isset($JSON)) {
				if ($JSON->APIKey === $this->APIKey) {
					// APIKey is valid
					return true;
				}
			}
		}

		// Something happend :)
		$this->setAttempt($_SERVER['REMOTE_ADDR']);

		// Send new headers.
		$this->setHTTPStatusCode($this->errorCode['blocked']);

		// Say wrong APIKey
		header("API-Key: Invalid");

		echo (
			json_encode(
				array(
					// Send Status
					"status" => "Failed",

					// Send warning
					"warning" => "You are using an invalid API key for this service.",

					// Send details
					"details" => sprintf(
						"BaaS/%s, Connection: Close, IP-Address: %s",
						$this->APIVer, $_SERVER['REMOTE_ADDR']
					),

					// Send API key back
					"apiKey" => (
						isset($_POST['APIKey']) ? $_POST['APIKey'] : (
							@json_decode($_POST['JSON'])->APIKey
							? @json_decode($_POST['JSON'])->APIKey
							: 'None prodived'
						)
					),
				)
			)
		);

		// Exit
		// 0 means no error, since we'll want to output the error.
		exit($this->isCLI ? 1 : 0);

		return false;
	}

	/**
	 * Get tablename from SQL Query.
	 *
	 * Supported:
	 * <pre>
	 *     SELECT WHATEVER FROM WHERE  ...
	 *     INSERT * INTO X VALUES ()
	 *     DELETE FROM X WHERE ...
	 *     CREATE TABLE X ()
	 * </pre>
	 *
	 * @since 1.0
	 * @param string $sqlQuery The SQL Query
	 * @return string the table name
	 */
	protected function tableFromSQLString($sqlQuery) {
		// Check if we can find the table, from the SQL Command
		// Supported:
		//   SELECT WHATEVER FROM WHERE  ...
		//   INSERT * INTO X VALUES ()
		//   DELETE FROM X WHERE ...
		//   CREATE TABLE X ()
		preg_match_all(
			// Regular expression
			"/(FROM|INTO|FROM|TABLE) (`)?([a-zA-Z0-9\_\-]+)(`)?/i",

			// Matches the Query?
			$sqlQuery,

			// Return matches
			$match
		);

		// There's a match!
		if (isset($match[3][0])) {
			// And check if it is not empty.
			if (!empty($match[3][0])) {
				// Found table name!
				return $match[3][0];
			}
		}

		// Something Happend...
		return "Error";
	}

	/**
	 * Does our table exists?
	 *
	 * @since 1.0
	 * @param String $tableName table name
	 */
	protected function tableExists($tableName) {
		if (!isset($this->db)) {
			echo json_encode(
				array(
					// Send Status
					"status" => "Failed",

					// Send error message
					"error" => "Not connected to a database",

					// Send how-to-fix
					"fix" => "Please check the database configuration",

					// Send debug text if debugmode is on.
					"debug" => ($this->debugmode ? $this->dbConfig : 'Off'),
				)
			);

			exit($this->isCLI ? 1 : 0);
		}

		// Check database type
		if ($this->dbConfig['type'] == "mysql") {
			// Return
			return (
				// Query
				$this->db->query(
					// Internal select DB method
					sprintf(
						// Select count(*)
						"SELECT count(*) FROM information_schema.tables WHERE table_name = '%s'",

						// Santisize input
						$this->escapeString(
							preg_replace(
								// `
								"/`/",

								// \`
								"\\`",

								// tableName
								$tableName
							)
						)
					)
					// FetchColumns is more then 0 then the table exists.
				)->fetchColumn() > 0
			);
		}

		// We'll going SQLite
		return (
			// Query
			$this->db->query(
				// Internal select DB method
				sprintf(
					// Select count(*)
					"select count(*) FROM `sqlite_master` WHERE `type`='table' AND `name`='%s'",

					// Santisize input
					$this->escapeString(
						preg_replace(
							// `
							"/`/",

							// \`
							"\\`",

							// tableName
							$tableName
						)
					)
				)
				// FetchColumns is more then 0 then the table exists.
			)->fetchColumn() > 0
		);
	}

	/**
	 * Set the debugmode
	 *
	 * @since 1.0
	 * @param bool $status On or Off
	 */
	public function setDebugmode($status) {
		// Set the debugmode
		$this->debugmode = $status;
	}

	/**
	 * Set the lifetime of a (user) session
	 *
	 * @since 1.0
	 * @param bool $sessionTimeValue Time string like "+1 month"
	 */
	public function setSessionTime($sessionTimeValue) {
		$this->sessionTime = $sessionTimeValue;
	}

	/**
	 * Set bind to IP on/off
	 *
	 * @since 1.0
	 * @param bool $bindToIPValue On or Off (default false)
	 */
	public function setBindToIP($bindToIPValue) {
		$this->bindToIP = is_bool($bindToIPValue) ? $bindToIPValue : false;
	}

	/**
	 * Set the email address
	 *
	 * @since 1.0
	 * @param bool $emailAddress email address
	 */
	public function setEmailAddress($emailAddress) {
		// Set the debugmode
		$this->emailAddress = $emailAddress;
	}

	/**
	 * Set the API Key
	 *
	 * @since 1.0
	 * @param string $newAPIKey API Key
	 */
	public function setRegisteredAPIKey($newAPIKey) {
		// Set the API Key
		$this->APIKey = $newAPIKey;
	}

	/**
	 * Set Maximum tries
	 *
	 * @since 1.0
	 * @param int $setMaximumTries Maximum tries
	 */
	public function setMaximumInvalidTries($setMaximumTries) {
		// Set Maximum tries
		$this->triesMaximum = $setMaximumTries;
	}

	/**
	 * Set Maximum tries (in time)
	 *
	 * @since 1.0
	 * @param string $setTriesTime Time in strtotime format
	 */
	public function setTriesTime($setTriesTime) {
		// Set Maximum tries (in time)
		$this->triesTime = $setTriesTime;
	}

	/**
	 * get Database Type
	 *
	 * @since 1.0
	 * @return string Database Type
	 */
	public function databaseType() {
		// Return database type
		return $this->dbConfig['type'];
	}

	/**
	 * Set invalid attempt
	 *
	 * @since 1.0
	 * @param string $IPAddress the ip address
	 */
	private function setAttempt($IPAddress) {
		// set tries to 1
		$tries = 0;

		// if we have a archive read it.
		if (file_exists($this->BFfile)) {
			// get tries as int.
			$tries = (int) file_get_contents($this->BFfile);
		}

		// try +1
		$tries++;

		// Do not save anymore if more then 3 attempts registered.
		if ($tries < $this->triesMaximum) {
			// save try count
			file_put_contents($this->BFfile, $tries);
		}
	}

	/**
	 * Reset old login attempts
	 * @since 1.0
	 */
	private function resetOldAttempts() {
		// Create a list with all blocked users.
		$blockedList = glob(
			// Get correct file path
			sprintf(
				// BFDir/%s.txt
				$this->BFfile,

				// %s = *
				"*"
			)
		);

		// Walk trough the blocked IP-list
		for ($i = 0; $i < sizeof($blockedList); $i++) {
			// If the time is more then the maximum
			if (time() > strtotime($this->triesTime, filemtime($blockedList[$i]))) {
				// Reset the login attempt.
				unlink($blockedList[$i]);
			}
		}
	}

	/**
	 * Serve the BaaS Server.
	 *
	 * @since 1.0
	 * @return mixed|string Page contents (JSON/HTML)
	 */
	public function serve() {
		// If exists (DATABASE_TYPE)
		if (!empty($this->dbConfig['type'])) {
			// Try it
			try {
				// Connect to our SQLite database
				if ($this->dbConfig['type'] == "mysql") {
					// If defined $this->dbConfig['host'], $this->dbConfig['name'],
					// $this->dbConfig['user']
					if (
						// Is the Host empty?
						!empty($this->dbConfig['host']) &&

						// Is the Name empty?
						!empty($this->dbConfig['name']) &&

						// Is the User empty?
						!empty($this->dbConfig['user'])) {
						// Then let's try to connect!
						$this->db = new \PDO(
							// Sprintf mysql:...
							sprintf(
								// mysql:host=$this->dbConfig['host'];
								// dbname=$this->dbConfig['name'];charset=UTF8mb4
								"mysql:host=%s;dbname=%s;charset=UTF8mb4",

								// Host
								$this->dbConfig['host'],

								// DB Name
								$this->dbConfig['name']
							),

							// Username
							$this->dbConfig['user'],

							// Password
							$this->dbConfig['pass']
						);
					}
				} else {
					// SQLite!
					if (!empty($this->dbConfig['path'])) {
						// Try to create/load a SQLite database
						$this->db = new \PDO(
							// sqlite:DBName.sqlite
							sprintf(
								// sqlite:DBName.sqlite
								'sqlite:%s',

								// Database Path
								$this->dbConfig['path']
							)
						);
					}
				}
				// Set the error mode
				$this->db->setAttribute(
					// Set the error mode
					\PDO::ATTR_ERRMODE,

					// To Trow Exceptions.
					\PDO::ERRMODE_EXCEPTION
				);
			} catch (PDOException $e) {
				// Handle the exception
				return $this->handleException($e);
			}
		} else {
			echo json_encode(
				array(
					// Send Status
					"status" => "Failed",

					// Send Error message
					"error" => "Missing server type, cannot continue.",

					// Send how-to-fix
					"fix" => "Please review your configuration settings",
				)
			);
		}

		// Does the database resource exists?
		if (!isset($this->db)) {
			// Create error report
			echo json_encode(
				// Make a array
				array(
					// Send Status
					"status" => "Failed",

					// Send Error message
					"error" => sprintf(
						// Failed to connect to the TYPE database
						"Failed to connect to the %s database",

						// Database Type
						$this->dbConfig['type']
					),

					// Send how-to-fix
					"fix" => "Please review your configuration settings",

					// Send server information
					"server" => array(
						// Send server type
						"type" => $this->dbConfig['type'],

						// Send server status
						"status" => (
							// Is it a SQL Server?
							$this->dbConfig['type'] == 'mysql'

							// Test if the server is available
							 ? $this->isTheServerAvailable($this->dbConfig['host'])

							// No error report.
							 : 'N/A'
						),
					),
				)
			);
			// Error
			// Exit with 0 so that we don't get http 500 errors.
			exit($this->isCLI ? 1 : 0);
		}

		// Check if there is a DATABASE_TYPE defined.
		if ($this->error) {
			// JSON Error
			return json_encode(
				// Array
				array(
					// Send Status
					"status" => "Failed",

					// Database type is missing
					"error" => !empty($this->errorMessage)

					// The error message
					 ? $this->errorMessage

					// No database type is selected
					 : "No database type is selected",

					// Show a fix
					"fix" => "Check the documentation!",
				)
			);
		}

		// If the type is empty.
		if (empty($this->dbConfig['type'])) {
			// JSONify Error
			return json_encode(
				// Array
				array(
					// Send Status
					"status" => "Failed",

					// Send error message
					"error" => "Not connected to a database!",

					// Send how-to-fix
					"fix" => "Set database configuration.",

					// Send server/database type
					"type" => $this->dbConfig['type'],
				)
			);
		}

		// Check if the TYPE = MySQL
		if ($this->dbConfig['type'] == "mysql") {
			// Check if there is a $this->dbConfig['host'] defined.
			if (empty($this->dbConfig['host'])) {
				// Missing, so return a error.
				return json_encode(
					// Array
					array(
						// Send Status
						"status" => "Failed",

						// Database host is missing
						"error" => "No database host is entered",

						// Show a fix
						"fix" => "Please select a valid database host",
					)
				);
			}
			// Check if there is a $this->dbConfig['name'] defined.
			if (empty($this->dbConfig['name'])) {
				// Missing, so return a error.
				return json_encode(
					// Array
					array(
						// Send Status
						"status" => "Failed",

						// Database name is missing
						"error" => "No database name is entered",

						// Show a fix
						"fix" => "Please select a valid database name",
					)
				);
			}

			// Check if there is a $this->dbConfig['user'] defined.
			if (empty($this->dbConfig['user'])) {
				// Missing, so return a error.
				return json_encode(
					// Array
					array(
						// Send Status
						"status" => "Failed",

						// Database user is missing
						"error" => "No database user is entered",

						// Show a fix
						"fix" => "Please select a valid database user",
					)
				);
			}
		}

		// Check if block file path is writeable
		if (!is_writeable($this->blockFilePath)) {
			// Re chmod
			@chmod($this->blockFilePath, 0777);
		}

		// Check if block file path is writeable
		if (!is_writeable($this->blockFilePath)) {
			// error, we cannot continue now.
			return json_encode(
				// Array
				array(
					// Send Status
					"status" => "Failed",

					// File path is not writeable
					"error" => "File path is not writeable",

					// Show file path
					"FilePath" => $this->blockFilePath,
				)
			);
		}

		// Reset old attempts
		$this->resetOldAttempts();

		// Asking for CSS.
		if ($_SERVER['REQUEST_URI'] == "/css.css") {
			header("Content-type: text/css");
			if (file_exists('Data/Admin/css.css')) {
				return file_get_contents('Data/Admin/css.css');
			}
			exit;
		}

		// Asking for Javascript.
		if ($_SERVER['REQUEST_URI'] == "/js.js") {
			header("Content-type: application/javascript");
			if (file_exists('Data/Admin/js.js')) {
				return file_get_contents('Data/Admin/js.js');
			}
			exit;
		}

		// Handle /db.admin/ methods
		if (
			// Check if it matches "/db.admin/"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/db\.admin(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// Run "DBAdmin"
			return $this->DBAdmin(
				// If no action then show index
				empty($action[2][0])

				// Set index
				 ? 'index'

				// Custom index
				 : $action[2][0]
			);
		}

		// Handle /row.get/xxx methods
		if (
			// Check if it matches "/row.get/"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/row\.get(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// If /row.get/MAYNOTBEEMPTY is nog empty
			if (!empty($action[2][0])) {
				// Run "rowAction"
				return $this->rowAction(
					// With value xxx
					$action[2][0],

					// It's a get action
					"get"
				);
			}
		}

		// Handle /row.set/xxx methods
		if (
			// Check if it matches "/row.set/"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/row\.set(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// If /row.set/MAYNOTBEEMPTY is nog empty
			if (!empty($action[2][0])) {
				// Parse and echo
				return $this->rowAction(
					// With value xxx
					$action[2][0],

					// It's a set action
					"set"
				);
			}
		}

		// Handle /row.remove/xxx methods
		if (
			// Check if it matches "/row.remove/"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/row\.remove(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// If /row.remove/MAYNOTBEEMPTY is nog empty
			if (!empty($action[2][0])) {
				// Parse and echo
				return $this->rowAction(
					// With value xxx
					$action[2][0],

					// It's a remove action
					"remove"
				);
			}
		}

		// Handle /row.create/xxx methods
		if (
			// Check if it matches "/row.create/"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/row\.create(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// If /row.create/MAYNOTBEEMPTY is nog empty
			if (!empty($action[2][0])) {
				// Parse and echo
				return $this->rowCreate(
					// With value xxx
					$action[2][0]
				);
			}
		}

		// Handle /table.create/xxx methods
		if (
			// Check if it matches "/table.create/"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/table\.create(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// If /table.create/MAYNOTBEEMPTY is nog empty
			if (!empty($action[2][0])) {
				// Parse and echo
				return $this->tableCreate(
					// With value xxx
					$action[2][0]
				);
			}
		}

		// Handle /table.empty/xxx methods
		if (
			// Check if it matches "/table.empty/"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/table\.empty(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// If /table.empty/MAYNOTBEEMPTY is nog empty
			if (!empty($action[2][0])) {
				// Parse and echo
				return $this->tableEmpty(
					// With value xxx
					$action[2][0]
				);
			}
		}

		// Handle /table.remove/xxx methods
		if (
			// Check if it matches "/table.remove/"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/table\.remove(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// If /table.remove/MAYNOTBEEMPTY is nog empty
			if (!empty($action[2][0])) {
				// Parse and echo
				return $this->tableRemove(
					// With value xxx
					$action[2][0]
				);
			}
		}

		// Handle /table.rename/xxx methods
		if (
			// Check if it matches "/table.rename/"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/table\.rename(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// If /table.rename/MAYNOTBEEMPTY is nog empty
			if (!empty($action[2][0])) {
				// Parse and echo
				return $this->tableRename(
					// With value xxx
					$action[2][0]
				);
			}
		}

		// Handle "/user.create" methods
		if (
			// Check if it matches "/user.create"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/user\.create(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// Run "User create"
			return $this->userCreate(
				urldecode(
					$action[2][0]
				)
			);
		}

		// Handle "/user.exists" methods
		if (
			// Check if it matches "/user.exists"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/user\.exists(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// Run "User exists"
			return $this->userExists(
				urldecode(
					$action[2][0]
				)
			);
		}

		// Handle "/user.remove" methods
		if (
			// Check if it matches "/user.remove"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/user\.remove(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// Run "User Remove"
			return $this->userRemove(
				urldecode(
					$action[2][0]
				)
			);
		}

		// Handle "/user.login" methods
		if (
			// Check if it matches "/user.login"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/user\.login(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// Run "User Login"
			return $this->userLogin(
				urldecode(
					$action[2][0]
				)
			);
		}

		// Handle "/user.reset" methods
		if (
			// Check if it matches "/user.reset"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/user\.reset(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// Run "User reset"
			return $this->userReset(
				urldecode(
					$action[2][0]
				)
			);
		}

		// Handle "/user.activate" methods
		if (
			// Check if it matches "/user.activate"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/user\.activate(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// Run "User activate"
			return $this->userActivate(
				urldecode(
					$action[2][0]
				)
			);
		}

		// Handle "/file.exists" methods
		if (
			// Check if it matches "/file.exists"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/file\.exists(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// Run "file exists"
			return $this->fileExists(
				urldecode(
					$action[2][0]
				)
			);
		}

		// Handle "/file.download" methods
		if (
			// Check if it matches "/file.download"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/file\.download(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// Run "file download"
			return $this->fileDownload(
				urldecode(
					$action[2][0]
				)
			);
		}

		// Handle "/file.remove" methods
		if (
			// Check if it matches "/file.remove"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/file\.remove(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// Run "file remove"
			return $this->fileRemove(
				urldecode(
					$action[2][0]
				)
			);
		}

		// Handle "/file.upload" methods
		if (
			// Check if it matches "/file.upload"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/file\.upload(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// check the API KEY
			$this->checkAPIKey();

			// Run "file upload"
			return $this->fileUpload(
				urldecode(
					$action[2][0]
				)
			);
		}

		// Handle "/diag", "/diagnose", "/diagnostics" methods
		if (
			// Check if it matches "/diag", "/diagnose", "/diagnostics"
			preg_match_all(
				// escape "." and allow everything after "/"
				"/diag(nos)?(e|tics)?(\/?)(.*)/",

				// The current requested url
				$_SERVER['REQUEST_URI'],

				// Save to $action
				$action
			)
		) {
			// Run "Diagnosis"
			return $this->diagnosis(
				urldecode(
					$action[4][0]
				)
			);
		}

		// Handle extensions
		// Below official calls, so that this cannot overwrite default functions.
		for ($i = 0; $i < sizeof($this->extensions); $i++) {
			// Check if the custom URL matches the current URL
			if (
				// Create a match case
				preg_match_all(
					// Get the custom URL
					$regex = sprintf(
						// Create a regex
						"/%s(\/?)(.*)/",

						// Secure . to \.
						preg_replace(
							// .
							"/\./",

							// to \.
							"\\.",

							// Custom URL
							$this->extensions[$i][0]
						)
					),

					// The current requested url
					$_SERVER['REQUEST_URI'],

					// Save to $action
					$action
				)
			) {
				// Check if we need a API Key
				if ($this->extensions[$i][2]) {
					// Check if we have valid API Key
					$this->checkAPIKey();
				}

				// Call and return the user function
				return call_user_func_array(
					// User function (extension)
					$this->extensions[$i][1],

					// Always pass one array, with one value
					array(
						// Value after "/", if present
						$action[2][0],

						// Append $BaaS for extensions
						$this,
					)
				);
			}
		}

		// Oh, dear, that is a invalid request.
		return $this->invalidRequest();
	}

	/**
	 * Create user
	 *
	 * @since 1.0
	 * @param string $userID The user's id
	 * @return string JSON Data.
	 */
	private function userCreate($userID) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		if ($this->userRegistrationDisabled) {
			return json_encode(
				array(
					"status" => "Failed",
					"details" => "Registration disabled",
				)
			);
		}

		// Check if they posted a JSON
		if (isset($_POST['JSON'])) {
			// Can we decode it?
			$jsonData = json_decode($_POST['JSON'], true);

			// Sucesfully decoded?
			if (is_array($jsonData)) {
				if ($this->userExists($jsonData['username'])) {
					return json_encode(
						array(
							"status" => "Failed",
							"details" => "Username already taken",
							"fix" => "Choose another username",
						)
					);
				}

				if ($this->userExists($jsonData['email'])) {
					return json_encode(
						array(
							"status" => "Failed",
							"details" => "Email already used",
							"fix" => "Forget your password?",
						)
					);
				}

				// Create the query to create the user.
				$sqlQuery = sprintf(
					// SELECT
					"INSERT INTO `%s` (
                        `username`,
                        `password`,
                        `email`,
                        `status`,
                        `activationToken`,
                        `recoveryToken`
                    ) VALUES (
                        :username,
                        :password,
                        :email,
                        '1',
                        :activationToken,
                        :recoveryToken
                    );",

					// Tablename
					$this->defaultTables['users']
				);

				// Run query with parameters
				$databaseValues = $this->queryWithParameters(
					// the sql query
					$sqlQuery,

					// the parameters
					array(
						'username' => $this->escapeString($jsonData['username']),
						'password' => $this->hashPassword($jsonData['password']),
						'email' => $this->escapeString($jsonData['email']),
						'activationToken' => md5(time() . $jsonData['email']),
						'recoveryToken' => md5($jsonData['email'] . time()),
					)
				);

				return json_encode(
					array(
						"status" => "Success",
						"details" => "User account created",
						"userID" => $this->db->lastInsertId(),
					)
				);
			}
		}

		return $this->invalidRequest();
	}

	/**
	 * Does the user exists?
	 *
	 * @since 1.0
	 * @param string $userID The user's id
	 * @return string JSON Data.
	 */
	private function userExists($userID) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		$sSql = "SELECT `username` FROM `%s` WHERE (`username` = :username or `email` = :email) LIMIT 1;";

		$databaseValues = $this->queryWithParameters(
			sprintf($sSql, $this->defaultTables['users']),
			array(
				'username' => $this->escapeString($userID),
				'email' => $this->escapeString($userID),
			)
		);

		return (
			@$databaseValues->Status == "Ok"
		);
	}

	/**
	 * Remove user
	 *
	 * @since 1.0
	 * @param string $userID The user's id
	 * @return string JSON Data.
	 */
	private function userRemove($userID) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		// email (if user did request)
		// remove if admin
		return $this->invalidRequest();
	}

	/**
	 * Login user
	 *
	 * @since 1.0
	 * @param string $userID The user's id
	 * @return string JSON Data.
	 */
	private function userLogin($userID) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		if ($this->userLoginDisabled) {
			return json_encode(
				array(
					"status" => "Failed",
					"sessionID" => md5(uniqid() . $_SERVER['REMOTE_ADDR']),
					"details" => "Login disabled",
				)
			);
		}

		// Check if they posted a JSON
		if (isset($_POST['JSON'])) {
			// Can we decode it?
			$jsonData = json_decode($_POST['JSON'], true);

			if (is_array($jsonData)) {
				$sSql = "SELECT `id`, `username` FROM `%s` WHERE
               (`username` = :username or `email` = :email )
              and
               `password` = :password
              LIMIT 1;
              ";

				$databaseValues = $this->queryWithParameters(
					sprintf($sSql, $this->defaultTables['users']),
					array(
						'username' => $this->escapeString(
							isset($jsonData['username'])
							? $jsonData['username']
							: ''
						),
						'email' => $this->escapeString(
							isset($jsonData['username'])
							? $jsonData['username']
							: ''
						),
						'password' => $this->hashPassword(
							isset($jsonData['password'])
							? $jsonData['password']
							: ''
						),
					)
				);

				if (@$databaseValues->status == "Ok") {
					// Save login token.
					if (!$this->tableExists($this->defaultTables['sessions'])) {
						$this->sessionDatabaseSetup();
					}

					// SessionID
					$sID = md5(uniqid() . $_SERVER['REMOTE_ADDR']);

					// setup the SQL Query
					$sSql = sprintf(
						// Complete query
						"%s%s%s",

						// Insert row
						sprintf(
							"INSERT INTO `%s` ",
							$this->defaultTables['sessions']
						),

						// Add id, sessionID, dateTime, and userID
						"(`id`, `sessionID`, `datetime`, `userID`) ",

						// link id, sessionID, dateTime, and userID
						"VALUES (NULL, :sessionID, NOW(), :userID);"
					);

					// Send parameters
					$parameters = array(
						// Session ID
						'sessionID' => $sID,

						// User ID
						'userID' => $databaseValues->id,
					);

					// Register session
					$this->queryWithParameters(
						// With SQL
						$sSql,

						// and Parameters
						$parameters
					);

					// Show the success!
					return json_encode(
						array(
							"status" => "Success",
							"sessionID" => $sID,
							"details" => "User logged in",
						)
					);
				} else {
					// Failed :'(
					return json_encode(
						array(
							"status" => "Failed",
							"sessionID" => md5(uniqid() . $_SERVER['REMOTE_ADDR']),
							"details" => "Username/Password incorrect",
						)
					);
				}
			} else {
				// invalid data.
			}
		}

		return $this->invalidRequest();
	}

	/**
	 * create session
	 *
	 * @since 1.0
	 * @param string $sessionID The session ID
	 * @return string JSON Data.
	 */
	private function sessionCreate($sessionID) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		return $this->invalidRequest();
	}

	/**
	 * invalidate session
	 *
	 * @since 1.0
	 * @param string $sessionID The session ID
	 * @return string JSON Data.
	 */
	private function sessionInvalidate($sessionID) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		return $this->invalidRequest();
	}

	/**
	 * [Administrator] invalidate all sessions
	 *
	 * @since 1.0
	 * @param string $sessionID The session ID
	 * @return string JSON Data.
	 */
	private function sessionAdminInvalidateAll($sessionID = 0) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		return $this->invalidRequest();
	}

	/**
	 * [Administrator] is login enabled?
	 *
	 * @since 1.0
	 * @param string $status The status
	 * @return string JSON Data.
	 */
	private function userAdminLoginEnabled($status) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		return $this->invalidRequest();
	}

	/**
	 * [Administrator] is register enabled?
	 *
	 * @since 1.0
	 * @param string $status The status
	 * @return string JSON Data.
	 */
	private function userAdminRegisterEnabled($status) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		return $this->invalidRequest();
	}

	/**
	 * [Administrator] set User status
	 *
	 * @since 1.0
	 * @param string $userID The user's id
	 * @return string JSON Data.
	 */
	private function userAdminStatus($userID) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		return $this->invalidRequest();
	}

	/**
	 * Reset userpassword
	 *
	 * @since 1.0
	 * @param string $userID The user's id
	 * @return string JSON Data.
	 */
	private function userReset($userID) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}
		if ($this->userExists($userID)) {

		}

		return $this->invalidRequest();
	}

	/**
	 * Activate user
	 *
	 * @since 1.0
	 * @param string $userID The user's id
	 * @return string JSON Data.
	 */
	private function userActivate($userID) {
		if (!$this->tableExists($this->defaultTables['users'])) {
			$this->userDatabaseSetup();
		}

		return $this->invalidRequest();
	}

	/**
	 * File Exists
	 *
	 * @since 1.0
	 * @param string $fileID File identifier
	 * @param boolean $asBoolean Return as Boolean?
	 * @return string JSON Data.
	 */
	private function fileExists($fileID, $asBoolean = false) {
		// Check if file database exists
		if (!$this->tableExists($this->defaultTables['files'])) {
			// No, Setup.
			$this->fileDatabaseSetup();

			// Do we need to return a boolean?
			if ($asBoolean) {
				return false;
			}

			// File not found.
			return json_encode(
				// as array
				array(
					// Set status
					"status" => "Failed",

					// File
					"file" => "Not found",

					// Database didn't exists
					"warning" => "Database didn't exists",

					// Does it exists now?
					"database" => (
						// Check if exists
						$this->tableExists($this->defaultTables['files'])

						// Yes
						 ? "Exists"

						// No
						 : "Does not exists!"
					),
				)
			);
		}

		// Ask
		$sqlQuery = sprintf(
			// Select the file ID
			"SELECT `id` FROM `%s` WHERE `filename`='%s' LIMIT 1;",

			// from the default table
			$this->defaultTables['files'],

			// Escape user input
			$this->escapeString($fileID)
		);

		// Count if we have found the file.
		$fileFound = ($this->db->query($sqlQuery)->rowCount() > 0);

		// Do we need to return a boolean?
		if ($asBoolean) {
			return $fileFound;
		}

		// Return to client
		return json_encode(
			// as array
			array(
				// Send status
				"status" => "Success",

				// Send file status
				"file" => $fileFound ? "Found" : "Not Found",
			)
		);
	}

	/**
	 * File Download
	 *
	 * @since 1.0
	 * @param string $fileID File identifier
	 * @return string JSON Data.
	 */
	private function fileDownload($fileID) {
		// Check if file database exists
		if (!$this->tableExists($this->defaultTables['files'])) {
			// No, Setup.
			$this->fileDatabaseSetup();

			// File not found.
			return json_encode(
				// as array
				array(
					// Set status
					"status" => "Failed",

					// File
					"file" => "Not found",

					// Database didn't exists
					"warning" => "Database didn't exists",

					// Does it exists now?
					"database" => (
						// Check if exists
						$this->tableExists($this->defaultTables['files'])

						// Yes
						 ? "Exists"

						// No
						 : "Does not exists!"
					),
				)
			);
		}

		// Check if the file exists
		if ($this->fileExists($fileID)) {
			// Create the query to get the file.
			$sqlQuery = sprintf(
				// SELECT
				"SELECT * FROM `%s` WHERE `%s`=%s LIMIT 1;",

				// Tablename
				$this->defaultTables['files'],

				// filename
				'filename',

				// :filename
				':filename'
			);

			// Run query with parameters
			$databaseValues = $this->queryWithParameters(
				// the sql query
				$sqlQuery,

				// the parameters
				array(
					// filename, escaped
					'filename' => $this->escapeString($fileID),
				)
			);

			// json encode the returning data
			return json_encode($databaseValues);
		}

		// Invalid request.
		return $this->invalidRequest();
	}

	/**
	 * File Remove
	 *
	 * @since 1.0
	 * @param string $fileID File identifier
	 * @return string JSON Data.
	 */
	private function fileRemove($fileID) {
		// Check if file database exists
		if (!$this->tableExists($this->defaultTables['files'])) {
			// No, Setup.
			$this->fileDatabaseSetup();

			// File not found.
			return json_encode(
				// as array
				array(
					// Set status
					"status" => "Failed",

					// File
					"file" => "Not found",

					// Database didn't exists
					"warning" => "Database didn't exists",

					// Does it exists now?
					"database" => (
						// Check if exists
						$this->tableExists($this->defaultTables['files'])

						// Yes
						 ? "Exists"

						// No
						 : "Does not exists!"
					),
				)
			);
		}

		if ($this->fileExists($fileID, true)) {
			// Ask
			$sqlQuery = sprintf(
				// Select the file ID
				"DELETE FROM `%s` WHERE `filename`=:filename LIMIT 1;",

				// from the default table
				$this->defaultTables['files']
			);

			$sqlParameters = array(
				"filename" => $this->escapeString($fileID),
			);

			// Count if we have found the file.
			$fileFound = $this->queryWithParameters($sqlQuery, $sqlParameters);

			// Return to client
			return json_encode(
				// as array
				array(
					// Send status
					"status" => "Success",

					// Send file status
					"file" => $fileFound ? "Removed" : "Not Removed",
				)
			);
		}

		// Return to client
		return json_encode(
			// as array
			array(
				// Send status
				"status" => "Success",

				// Send file status
				"file" => "Not Found",
			)
		);
	}

	/**
	 * File Upload
	 *
	 * @since 1.0
	 * @param string $fileID File identifier
	 * @return string JSON Data.
	 */
	private function fileUpload($fileID) {
		// Check if file database exists
		if (!$this->tableExists($this->defaultTables['files'])) {
			// No, Setup.
			$this->fileDatabaseSetup();

			// File not found.
			return json_encode(
				// as array
				array(
					// Set status
					"status" => "Failed",

					// File
					"file" => "Not found",

					// Database didn't exists
					"warning" => "Database didn't exists",

					// Does it exists now?
					"database" => (
						// Check if exists
						$this->tableExists($this->defaultTables['files'])

						// Yes
						 ? "Exists"

						// No
						 : "Does not exists!"
					),
				)
			);
		}

		// Check if they posted a JSON
		if (isset($_POST['JSON'])) {
			// Can we decode it?
			$jsonData = json_decode($_POST['JSON'], true);

			// Sucesfully decoded?
			if (is_array($jsonData)) {
				// Check if the filename does not exists.
				if ($this->fileExists($fileID, true)) {
					// Extract extension
					$fileExtension = explode('.', $fileID);

					// Do we have a extension?
					if (sizeof($fileExtension) > 1) {
						// Save extension for later use
						$fileExtension = $fileExtension[sizeof($fileExtension) - 1];
					} else {
						// No extension
						$fileExtension = '';
					}

					// New file name xxxxxx.extension
					$fileID = sprintf(
						// xxxx.extension
						"%s%s%s",

						// xxxx
						md5(uniqid()),

						// . or not?
						(!empty($fileExtension) ? '.' : ''),

						// Extension
						(!empty($fileExtension) ? $fileExtension : '')
					);
				}

				// Ok, do we have a file?!
				if (isset($jsonData['fileData'])) {
					// And do we have a extension?
					if (empty($fileExtension)) {
						// Can we regonize this file?
						if (!$fileExtension = $this->checkFileExtension($jsonData['fileData'])) {
							// Nope, no extension...
							$fileExtension = '';
						}
					}

					// Yup we can upload.
					if (!empty($jsonData['fileData'])) {
						// Its base64 encoded.
						$sqlQuery = sprintf(
							// INSERT INTO `tableName` (...) VALUES (...)
							"%s%s%s",

							// Insert into
							"INSERT INTO `",

							// File table
							$this->defaultTables['files'],

							// With columns and values
							"` (`filename`, `filedata`) VALUES (:fileName, :fileData);"
						);

						// Save parameters
						$sqlParameters = array(
							// File name
							'fileName' => $fileID,

							// File data (base64_encode(gzcompress(..., 5)))
							'fileData' => $jsonData['fileData'],
						);

						// Run the query!
						$fileQuery = $this->queryWithParameters(
							// SQL Query
							$sqlQuery,

							// SQL Parameters
							$sqlParameters
						);

						// Append the filename (in case it has changed)
						$fileQuery->fileName = $fileID;

						// Return the status.
						return json_encode($fileQuery);
					} else {
						// Return error
						return json_encode(
							// As array
							array(
								// Send status
								"status" => "Failed",

								// Send warning
								"warning" => "The file seems empty",

								// How-to-fix
								"fix" => "Send a file",
							)
						);
					}
				} else {
					// Return error
					return json_encode(
						// As array
						array(
							// Send status
							"status" => "Failed",

							// Send warning
							"warning" => "No file sended",

							// How-to-fix
							"fix" => "Send a file",
						)
					);
				}
			}
		}

		return $this->invalidRequest();
	}

	private function checkFileExtension($fileData) {
		if ($extractedFileData = base64_decode($fileData)) {
			if ($extractedFileData = @gzuncompress($extractedFileData)) {

				if (function_exists('exif_imagetype')) {
					switch (@exif_imagetype($extractedFileData)) {
					case IMAGETYPE_GIF:
						return 'gif';
						break;
					case IMAGETYPE_JPEG:
						return 'jpg';
						break;

					case IMAGETYPE_PNG:
						return 'png';
						break;

					case IMAGETYPE_SWF:
						return 'swf';
						break;

					case IMAGETYPE_PSD:
						return 'psd';
						break;

					case IMAGETYPE_BMP:
						return 'bmp';
						break;

					case IMAGETYPE_TIFF_II:
					case IMAGETYPE_TIFF_MM:
						return 'tiff';
						break;

					case IMAGETYPE_JPC:
						return 'jpc';
						break;

					case IMAGETYPE_JP2:
						return 'jp2';
						break;

					case IMAGETYPE_JPX:
						return 'jpx';
						break;

					case IMAGETYPE_JB2:
						return 'jb2';
						break;

					case IMAGETYPE_SWC:
						return 'swc';
						break;

					case IMAGETYPE_IFF:
						return 'iff';
						break;

					case IMAGETYPE_WBMP:
						return 'wemb';
						break;

					case IMAGETYPE_XBM:
						return 'xbm';
						break;

					case IMAGETYPE_ICO:
						return 'ico';
						break;

					case IMAGETYPE_WEBP:
						return 'webp';
						break;
					}
				} else {
					if (bin2hex($pict[0]) == 'ff' && bin2hex($pict[1]) == 'd8') {
						return 'jpg';
					}
					if (bin2hex($pict[0]) == '89' && $pict[1] == 'P' && $pict[2] == 'N' && $pict[3] == 'G') {
						return 'png';
					}
				}
			}
		}

		return false;
	}
	/**
	 * Setup user database
	 *
	 * @since 1.0
	 * @return void
	 */
	private function userDatabaseSetup() {
		// The creation SQL
		$sqlQuery = sprintf(
			// String for appending
			'%s%s%s%s%s%s%s%s%s%s%s%s',

			// Create table
			sprintf(
				"CREATE TABLE `%s` (\n",
				$this->defaultTables['users']
			),

			// id (auto incrementing)
			"\t`id` int(11) unsigned NOT NULL AUTO_INCREMENT,\n",

			// latitude
			"\t`latitude` text DEFAULT NULL,\n",

			// longitude
			"\t`longitude` text DEFAULT NULL,\n",

			// username
			"\t`username` text DEFAULT NULL,\n",

			// password
			"\t`password` text DEFAULT NULL,\n",

			// email
			"\t`email` text DEFAULT NULL,\n",

			// status
			"\t`status` text DEFAULT NULL,\n",

			// activationToken
			"\t`activationToken` text DEFAULT NULL,\n",

			// recoveryToken
			"\t`recoveryToken` text DEFAULT NULL,\n",

			// set the primary key.
			"\tPRIMARY KEY (`id`)\n",

			// End the create query.
			") ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=UTF8mb4;"
		);

		$this->db->query($sqlQuery);
	}

	/**
	 * Setup file database
	 *
	 * @since 1.0
	 * @return void
	 */
	private function fileDatabaseSetup() {
		// The creation SQL
		$sqlQuery = sprintf(
			// String for appending
			'%s%s%s%s%s%s%s',

			// Create table
			sprintf(
				"CREATE TABLE `%s` (\n",
				$this->defaultTables['files']
			),

			// id (auto incrementing)
			"\t`id` int(11) unsigned NOT NULL AUTO_INCREMENT,\n",

			// file name
			"\t`filename` text DEFAULT NULL,\n",

			// file data
			"\t`filedata` longtext DEFAULT NULL,\n",

			// username
			"\t`username` text DEFAULT NULL,\n",

			// set the primary key.
			"\tPRIMARY KEY (`id`)\n",

			// End the create query.
			") ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=UTF8mb4;"
		);

		$this->db->query($sqlQuery);
	}

	/**
	 * Setup Session database
	 *
	 * @since 1.0
	 * @return void
	 */
	private function sessionDatabaseSetup() {
		// The creation SQL
		$sqlQuery = sprintf(
			// String for appending
			"%s%s%s%s%s%s%s",

			// Create table
			sprintf(
				"CREATE TABLE `%s` (\n",
				$this->defaultTables['sessions']
			),

			// id (auto incrementing)
			"\t`id` int(11) unsigned NOT NULL AUTO_INCREMENT,\n",

			// Session ID
			"\t`sessionID` text DEFAULT NULL,\n",

			// Maximum lifetime
			"\t`datetime` datetime DEFAULT NULL,\n",

			// userID
			"\t`userID` int(11) DEFAULT NULL,\n",

			// set the primary key.
			"\tPRIMARY KEY (`id`)\n",

			// End the create query.
			") ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=UTF8mb4;"
		);

		$this->db->query($sqlQuery);
	}

	/**
	 * Invalid request
	 *
	 * @since 1.0
	 * @param string $request the type/value
	 * @return string JSON Error.
	 */
	protected function invalidRequest($request = 'Unknown') {
		// Set HTTP status code
		$this->setHTTPStatusCode($this->errorCode['invalidRequest']);

		// Explode the "uri" split all /'es
		$requestedURI = explode(
			// Split "/".
			"/",

			// Get the current url request.
			$_SERVER['REQUEST_URI']
		);

		// Get current method
		$method = (
			// If the size of the request > 2
			(sizeof($requestedURI) > 2)

			// Extracted method
			 ? $requestedURI[sizeof($requestedURI) - 2]

			// Unknown method
			 : 'Unknown'
		);

		// Display error to the user
		return json_encode(
			// Array
			array(
				// Send Status
				"status" => "Failed",

				// Error Message
				"error" => "Method not implented.",

				// Get current Method
				"method" => $method,

				// Wit. data
				"data" => $request,

				// Requested URI
				"reqURI" => $_SERVER['REQUEST_URI'],
			)
		);
	}

	/**
	 * Create table
	 *
	 * @since 1.0
	 * @param string $tableName the table name
	 * @return mixed
	 */
	private function tableCreate($tableName) {
		// table.create
		if ($this->tableExists($tableName)) {
			return json_encode(
				// In Array
				array(
					// Status
					"status" => "Failed",

					// Warning
					"warning" => "Database already exists.",

					// Possible-how-to-fix
					"fix" => "N/A",
				)
			);
		}

		// Create the SQL Command
		$sqlQuery = sprintf(
			// Create table.
			"CREATE TABLE `%s` (\n",

			// Escape the database
			$this->escapeString(
				// Replace insecure fields
				preg_replace(
					// `
					"/`/",

					// to \\`
					"\\`",

					// in $tableName
					$tableName
				)
			)
		);

		// Append default fields.
		// id (auto incrementing)
		$sqlQuery .= sprintf(
			// Required default field
			"\t`id` int(11) unsigned NOT NULL AUTO_INCREMENT,\n"
		);

		// latitude
		$sqlQuery .= sprintf(
			// Required default field
			"\t`latitude` text DEFAULT NULL,\n"
		);

		// longitude
		$sqlQuery .= sprintf(
			// Required default field
			"\t`longitude` text DEFAULT NULL,\n"
		);

		// Do we have JSON Data
		if (!isset($_POST['JSON'])) {
			// ERROR
			return json_encode(
				// In Array
				array(
					// Status
					"status" => "Failed",

					// Warning
					"warning" => "Missing JSON data",

					// Possible-how-to-fix
					"fix" => "Add JSON data",
				)
			);
		}

		// Decode JSON Data
		$d = json_decode(
			// Get the JSON Data
			$_POST['JSON'],

			// As Array
			true
		);

		// Is it a array?
		if (!is_array($d) && sizeof($d) < 1) {
			// ERROR
			return json_encode(
				// In Array
				array(
					// Status
					"status" => "Failed",

					// Warning
					"warning" => "Corrupt JSON data",

					// Possible-how-to-fix
					"fix" => "Please provide valid JSON data",
				)
			);
		}

		// Do we have fields?
		if (!isset($d['Fields'])) {
			// ERROR
			return json_encode(
				// In Array
				array(
					// Status
					"status" => "Failed",

					// Warning
					"warning" => "Missing fields",

					// Possible-how-to-fix
					"fix" => "Add fields",
				)
			);
		}

		// Loop trough the fields
		foreach ($d['Fields'] as $field) {
			// Check if a field is not in the of pre-reserved fields.
			if (!in_array($field['name'], $this->defaultFields)) {
				// Append to SQL Command
				$sqlQuery .= sprintf(
					// `fieldname` fieldtype canbeempty value/null
					"\t`%s` %s %s %s,\n",

					// Replace insecure text
					preg_replace(
						// `
						"/`/",

						// to \\`
						"\\`",

						// in $field
						$field['name']
					),

					// Check if our field is a number
					(
						// Check if our field is a number
						$field['type'] == 'number'

						// It's a Integer
						 ? "int(11)"

						// It's text
						 : "text"
					),

					// Can the field be empty?
					(
						// Can the field be empty?
						$field['canBeEmpty'] == 'yes'

						// DEFAULT (can be empty!)
						 ? "DEFAULT"

						// Can not be empty
						 : (
							!empty($field['defaultValue'])
							? ''
							: "NOT"
						)
					),

					// Can the field be empty?
					(
						// Can the field be empty?
						$field['canBeEmpty'] == 'no'

						// Nope, so ignore.
						 ? 'NULL'

						// Yes, do the math.
						 : (
							// Is the default value not empty?
							!empty($field['defaultValue'])

							// Nope, not empty
							 ? (
								// Needs number, and is the value numeric?
								$field['type'] == 'number' && is_numeric($field['defaultValue'])

								// The value is numeric!
								 ? sprintf(
									// ...
									"%s",

									// Escape the default Value
									$this->escapeString(
										// Get the default value
										$field['defaultValue']
									)
								)

								// No number when needed, so
								 : (
									// Needs number, and is the value numeric?
									$field['type'] == 'number' && !is_numeric($field['defaultValue'])

									// Nope so return 0
									 ? "0"

									// Return the value (string)
									 : sprintf(
										// '...'
										"'%s'",

										// Escape the default Value
										$this->escapeString(
											// Get the default value
											$field['defaultValue']
										)
									)
								)
							)

							// No default value, so NULL
							 : "NULL"
						)
					)
				);
			}
		}

		// set the primary key.
		$sqlQuery .= sprintf(
			// Required default field
			"\tPRIMARY KEY (`id`)\n"
		);

		// End the create query.
		$sqlQuery .= sprintf(
			// Required default engine
			") ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=UTF8mb4;"
		);

		// Exit with the sql command.
		if ($this->query($sqlQuery)) {
			// Return we'll did it
			return json_encode(
				// Array.
				array(
					// Return status
					"status" => "Success",

					// Information
					"info" => "Table created",
				)
			);
		}

		// Unexpected error
		return json_encode(
			// Array
			array(
				// Return status
				"status" => "Failed",

				// Information
				"info" => "Table not created",

				// How-To-Fix
				"fix" => "Turn on debugging to see this",

				// Debug?
				"debug" => (
					// Check if debugmode is on
					$this->debugmode

					// It's on so return SQL Query.
					 ? $sqlQuery

					// Debugmode disabled
					 : 'Debugmode disabled'
				),
			)
		);
	}

	/**
	 * Empty table
	 *
	 * @since 1.0
	 * @param string $tableName the table name
	 * @return mixed
	 */
	private function tableEmpty($tableName) {
		// Check if table exists
		if (!$this->tableExists($tableName)) {
			// Error
			return json_encode(
				// Array
				array(
					// Status
					"status" => "Failed",

					// Warning
					"warning" => "Table does not exists",

					// Possible-How-To-Fix
					"fix" => "Provide table name",
				)
			);
		}

		$sqlQuery = sprintf(
			// truncate table.
			"TRUNCATE TABLE `%s`;\n",

			// Escape the database
			$this->escapeString(
				// Replace insecure fields
				preg_replace(
					// `
					"/`/",

					// to \\`
					"\\`",

					// in $databaseName
					$tableName
				)
			)
		);

		// Exit with the sql command.
		if ($this->query($sqlQuery)) {
			// Return we'll did it
			return json_encode(
				// Array.
				array(
					// Return status
					"status" => "Success",

					// Information
					"info" => "Table emptied",
				)
			);
		}

		// Unexpected error
		return json_encode(
			// Array
			array(
				// Return status
				"status" => "Failed",

				// Information
				"info" => "Table not emptied",

				// How-To-Fix
				"fix" => "Turn on debugging to see this",

				// Debug?
				"debug" => (
					// Check if debugmode is on
					$this->debugmode

					// It's on so return SQL Query.
					 ? $sqlQuery

					// Debugmode disabled
					 : 'Debugmode disabled'
				),
			)
		);
	}

	/**
	 * Remove table
	 *
	 * @since 1.0
	 * @param string $tableName the table name
	 * @return mixed
	 */
	private function tableRemove($tableName) {
		// Check if table exists
		if (!$this->tableExists($tableName)) {
			// Error
			return json_encode(
				// Array
				array(
					// Status
					"status" => "Failed",

					// Warning
					"warning" => "Table does not exists",

					// Possible-How-To-Fix
					"fix" => "Provide table name",
				)
			);
		}

		// SQL Command
		$sqlQuery = sprintf(
			// Create table.
			"DROP TABLE `%s`;\n",

			// Escape the database
			$this->escapeString(
				// Replace insecure fields
				preg_replace(
					// `
					"/`/",

					// to \\`
					"\\`",

					// in $databaseName
					$tableName
				)
			)
		);

		// Exit with the sql command.
		if ($this->query($sqlQuery)) {
			// Return we'll did it
			return json_encode(
				// Array.
				array(
					// Return status
					"status" => "Success",

					// Information
					"info" => "Table removed",
				)
			);
		}

		// Unexpected error
		return json_encode(
			// Array
			array(
				// Return status
				"status" => "Failed",

				// Information
				"info" => "Table not removed",

				// How-To-Fix
				"fix" => "Turn on debugging to see this",

				// Debug?
				"debug" => (
					// Check if debugmode is on
					$this->debugmode

					// It's on so return SQL Query.
					 ? $sqlQuery

					// Debugmode disabled
					 : 'Debugmode disabled'
				),
			)
		);
	}

	/**
	 * Rename table
	 *
	 * @since 1.0
	 * @param string $tableName the table name
	 * @return mixed
	 */
	private function tableRename($tableName) {
		// Extract data
		$tables = explode(
			// Split "/"
			"/",

			// From
			$tableName
		);

		// If size is less then 1 then it's a missmatch
		if (sizeof($tables) < 1) {
			// As JSON
			return json_encode(
				// Array
				array(
					// Status
					"status" => "Failed",

					// Warning
					"warning" => "Missing new table name",

					// Possible-How-To-Fix
					"fix" => "Provide table name",
				)
			);
		}

		if (!$this->tableExists($tables[0])) {
			return json_encode(
				// Array
				array(
					// Status
					"status" => "Failed",

					// Warning
					"warning" => "Table \"{$tables[0]}\" does not exists",

					// Possible-How-To-Fix
					"fix" => "Provide table name",
				)
			);
		}

		if ($this->tableExists($tables[1])) {
			return json_encode(
				// Array
				array(
					// Status
					"status" => "Failed",

					// Warning
					"warning" => "New table name does already exists",

					// Possible-How-To-Fix
					"fix" => "Provide new table name",
				)
			);
		}

		// SQL Command
		$sqlQuery = sprintf(
			// Rename table.
			"RENAME TABLE `%s` TO `%s`;\n",

			// Escape the tables
			$this->escapeString(
				// Replace insecure fields
				preg_replace(
					// `
					"/`/",

					// to \\`
					"\\`",

					// in $tables[0]
					$tables[0]
				)
			),

			// Escape the tables
			$this->escapeString(
				// Replace insecure fields
				preg_replace(
					// `
					"/`/",

					// to \\`
					"\\`",

					// in $tables[1]
					$tables[1]
				)
			)
		);

		// Exit with the sql command.
		if ($this->query($sqlQuery)) {
			// Return we'll did it
			return json_encode(
				// Array.
				array(
					// Return status
					"status" => "Success",

					// Information
					"info" => "Table renamed",
				)
			);
		}

		// Unexpected error
		return json_encode(
			// Array
			array(
				// Return status
				"status" => "Failed",

				// Information
				"info" => "Table not renamed",

				// How-To-Fix
				"fix" => "Turn on debugging to see this",

				// Debug?
				"debug" => (
					// Check if debugmode is on
					$this->debugmode

					// It's on so return SQL Query.
					 ? $sqlQuery

					// Debugmode disabled
					 : 'Debugmode disabled'
				),
			)
		);
	}

	/**
	 * SQL query
	 *
	 * @since 1.0
	 * @param string $query the SQL Query
	 * @return mixed
	 */
	protected function query($query) {
		// Execute the query
		return $this->db->query($query);
	}

	/**
	 * Escape SQL query
	 *
	 * @since 1.0
	 * @param string $insecureInput the unsecure SQL Query
	 * @return string the (more)secure SQL Query
	 */
	protected function escapeString($insecureInput) {
		// Replace unsafe characters
		return str_replace(
			// Unsafe
			array(
				// Replace \
				"\\",

				// Replace \0
				"\x00",

				// Replace \n (newline)
				"\n",

				// Replace \r (newline)
				"\r",

				// Replace '
				"'",

				// Replace \Z
				"\x1a",
			),

			// Sanitized
			array(
				// To (escaped (\)) \
				"\\\\",

				// To (escaped (\)) \0
				"\\0",

				// To (escaped (\)) \n (newline)
				"\\n",

				// To (escaped (\)) \r (newline)
				"\\r",

				// To (escaped (\)) \'
				"\'",

				// To (escaped (\)) \Z
				"\\Z",

				// Replace
			),

			// Original input
			$insecureInput
		);
	}

	/**
	 * Row Set/Get/Delete
	 *
	 * This function translates the user input to a understandable value for the database
	 *
	 * @since 1.0
	 * @param string $databaseName
	 * @internal
	 * @return mixed
	 */
	private function rowAction($databaseName, $action = "get") {
		// First, decode the JSON input.
		$decodedJSON = json_decode(
			// JSON input
			$_POST['JSON'],

			// to array
			true
		);

		// If the size of decoded JSON < 1 or not a array
		if (
			// Check if it is not a array
			!is_array($decodedJSON) ||

			// Or the size is less then 1
			sizeof($decodedJSON) < 1
		) {
			// return error
			return array(
				// Send Status
				"status" => "Failed",

				// Send error
				"error" => "Please post JSON",

				// Send how-to-fix
				"fix" => "Failed to decode JSON",
			);
		}

		// Create empty bindings array
		$bindings = array();

		// Start creating the SQL command!
		$sqlQuery = "";

		// What do we need to do?
		switch ($action) {
		// Get something
		// row.get
		case 'get':
			// SQL Command
			$sqlQuery = sprintf(
				// Select .. FROM `database`
				"SELECT %s FROM `%s`",

				// Select * (all)
				"*",

				// Escape the database
				$this->escapeString(
					// Replace insecure fields
					preg_replace(
						// `
						"/`/",

						// to \\`
						"\\`",

						// in $databaseName
						$databaseName
					)
				)
			);
			break;

		// Set/Update something
		// row.set
		case 'set':
			// Check if we have values
			if (!isset($decodedJSON['values'])) {
				// Return error message
				return json_encode(
					array(
						// Send Status
						"status" => "Failed",

						// Missing value
						"error" => "Can not update nothing",

						// Which one?
						"fix" => "Use: values[[key, value]]",
					)
				);
			}

			// SQL Command
			$sqlQuery = sprintf(
				// Select .. FROM `database`
				"UPDATE `%s` SET ",

				// Escape the database
				$this->escapeString(
					// Replace insecure fields
					preg_replace(
						// `
						"/`/",

						// to \\`
						"\\`",

						// in $databaseName
						$databaseName
					)
				)
			);
			break;

		// Delete something
		// row.remove
		case 'remove':
			// SQL Command
			$sqlQuery = sprintf(
				// Select .. FROM `database`
				"DELETE FROM `%s`",

				// Escape the database
				$this->escapeString(
					// Replace insecure fields
					preg_replace(
						// `
						"/`/",

						// to \\`
						"\\`",

						// in $databaseName
						$databaseName
					)
				)
			);
			break;

		// This should never happen
		default:
			// JSON encode
			return json_encode(
				// Error messages
				array(
					// Send Status
					"status" => "Failed",

					// Invalid request
					"error" => "Invalid request",

					// Invalid action
					"reqURI" => $action,
				)
			);
			break;
		}

		// Check if "where" exists!
		if (isset($decodedJSON['values'])) {
			// Check if we have values
			if (is_array($decodedJSON['values'])) {
				// Parse trough our values
				for ($i = 0; $i < sizeof($decodedJSON['values']); $i++) {
					// Check if there were enough values sended
					if (sizeof($decodedJSON['values'][$i]) == 1) {
						// If i is more then 0 append a , seporator
						if ($i > 0) {
							// Append seporator
							$sqlQuery .= ', ';
						}

						// Create for every statement a Parameter ID.
						$paramID = "x" . uniqid();

						// First parameter cleanup.
						$firstParameter = trim(
							strip_tags(
								$decodedJSON['values'][$i][0]
							)
						);

						// Append `%s` = :paramID
						// values %s = firstParameter
						$sqlQuery .= sprintf(
							"`%s` = :%s",
							preg_replace(
								// Replace `
								"/`/",

								// With \`
								"\\`",

								// in
								$firstParameter
							),
							$paramID
						);

						// Append paramID with value to our array
						$bindings[$paramID] = $decodedJSON['values'][$i][1];
					} else {
						// Show error
						return json_encode(
							// Array
							array(
								// Send Status
								"status" => "Failed",

								// Show error
								"error" => "Incorrect number of (set) parameters [Expected: 2]",

								// Return sended values
								"where" => $decodedJSON['values'][$i],
							)
						);
					}
				}
			}
		}

		// Check if "where" exists!
		if (isset($decodedJSON['where'])) {
			// Check if it is a "array"
			if (is_array($decodedJSON['where'])) {
				// Append " WHERE " to the SQL command
				$sqlQuery .= " WHERE ";

				// needs to be a sub-array
				// [xxx, eq, xxx]
				// [xxx, neq, xyz]
				// [xxx, like, xx]
				// [lat,lon, location, maxRangeInKM]
				//
				// Translate.
				// SELECT KEY FROM DATABASE WHERE
				// ...

				// Loop trough all "where" statements
				for ($i = 0; $i < sizeof($decodedJSON['where']); $i++) {
					// Check if we have the 'where' field.
					// With 3 parameters.
					if (sizeof($decodedJSON['where'][$i]) == 3) {
						// Create for every statement a Parameter ID.
						$paramID = "x" . uniqid();

						// If we are more then id 0 then
						if ($i > 0) {
							// append " AND" to SQL command
							$sqlQuery .= " AND ";
						}

						// Switch type (eq, neq, loc, like) (lowercased)
						switch (strtolower($decodedJSON['where'][$i][1])) {
						// Equals to
						case 'eq':
						case '=':
							// First parameter cleanup.
							$firstParameter = trim(
								// Strip html tags
								strip_tags(
									// JSON Value
									$decodedJSON['where'][$i][0]
								)
							);

							// Append `%s` = :paramID
							// where %s = firstParameter
							$sqlQuery .= sprintf(
								"`%s` = :%s",
								preg_replace(
									// Replace `
									"/`/",

									// With \`
									"\\`",

									// in
									$firstParameter
								),

								// Parameter ID
								$paramID
							);

							// Append paramID with value to our array
							$bindings[$paramID] = $decodedJSON['where'][$i][2];

							// End
							break;

						// Not equals to
						case 'neq':
						case '!=':
							// First parameter cleanup.
							$firstParameter = trim(
								// Strip tags
								strip_tags(
									// Decoded Parameter
									$decodedJSON['where'][$i][0]
								)
							);

							// Append `%s` != :paramID
							// where %s = firstParameter
							$sqlQuery .= sprintf(
								"`%s` != :%s",
								preg_replace(
									// Replace `
									"/`/",

									// With \`
									"\\`",

									// in
									$firstParameter
								),

								// Parameter ID
								$paramID
							);

							// Append paramID with value to our array
							$bindings[$paramID] = $decodedJSON['where'][$i][2];

							// End
							break;

						// Like
						case 'like':
							// First parameter cleanup.
							$firstParameter = trim(
								// Strip (html) tags
								strip_tags(
									// JSON Value
									$decodedJSON['where'][$i][0]
								)
							);

							// Append `%s` LIKE :paramID
							// where %s = firstParameter
							$sqlQuery .= sprintf(
								"`%s` LIKE :%s",
								preg_replace(
									// Replace `
									"/`/",

									// With \`
									"\\`",

									// in
									$firstParameter
								),

								// Parameter ID
								$paramID
							);

							// Append paramID with value to our array
							$bindings[$paramID] = $decodedJSON['where'][$i][2];
							break;

						// Search by location, this one is interesting.
						case 'loc':
						case 'location':
							// Explode "lat,lon" seperator = ,
							$locationData = explode(
								// Explode the ','
								",",

								// From JSON
								$decodedJSON['where'][$i][0]
							);

							// Create a unique Parameter ID for lat
							$latParamID = "x" . uniqid();

							// Create a unique Parameter ID for lon
							$lonParamID = "x" . uniqid();

							// Create a unique Parameter ID for Distance
							$disParamID = "x" . uniqid();

							if ($this->dbConfig['type'] == "sqlite") {
								// Append our special function to the SQL command
								// distance(latitude, longitude, $lat, $lon) is a custom function.
								$sqlQuery .= sprintf(
									"distance(latitude, longitude, :%s, :%s) < :%s",

									// Latitude Parameter ID
									$latParamID,

									// Longitude Parameter ID
									$lonParamID,

									// Distance Parameter ID
									$disParamID
								);
							} else {
								// Append our special calculatoion function to the SQL command
								$sqlQuery .= sprintf(
									"ST_Distance(point (latitude, longitude), point (:%s, :%s)) < :%s",

									// Latitude Parameter ID
									$latParamID,

									// Longitude Parameter ID
									$lonParamID,

									// Distance Parameter ID
									$disParamID
								);
							}

							// Append latitude Parameter ID to our array
							$bindings[$latParamID] = $locationData[0];

							// Append longitude Parameter ID to our array
							$bindings[$lonParamID] = $locationData[1];

							// Append distance Parameter ID to our array
							$bindings[$disParamID] = $decodedJSON['where'][$i][2];

							// End
							break;

						// We did not regonize this command
						default:
							// This should never happen.
							// But, you are never sure what will happen.

							// Check if we have created a " AND ".
							if (substr($sqlQuery, -5) == " AND ") {
								// Ok, let's remove it.
								$sqlQuery = substr($sqlQuery, 0, -5);
							}

							// End
							break;
						}
					} else {
						// Show error
						return json_encode(
							// Array
							array(
								// Send Status
								"status" => "Failed",

								// Show error
								"error" => "Incorrect number of (where) parameters [Expected: 3]",

								// Return values
								"where" => $decodedJSON['where'][$i],
							)
						);
					}
				}
			}
		}

		// Do we have a limit?
		if (isset($decodedJSON['limit'])) {
			// Is the limit numeric?
			if (is_numeric($decodedJSON['limit'])) {
				// Append the LIMIT {value} to our SQL Command
				$sqlQuery .= sprintf(" LIMIT %s", $decodedJSON['limit']);
			}
		}

		// And add a termination.
		$sqlQuery .= ";";

		// Transfer everything to JSON!
		return json_encode(
			// Execute our command, with our parameters
			$this->queryWithParameters(
				// SQL Command
				$sqlQuery,

				// Our bindings
				$bindings
			)
		);
	}

	/**
	 * Function for SQL to calculate distance between 2 coordination points
	 *
	 * @since 1.0
	 * @internal
	 * @param int $lat1 Latitude 1
	 * @param int $lon1 Longitude 1
	 * @param int $lat2 Latitude 2
	 * @param int $lon2 Longitude 2
	 * @return int Distance in kilometers
	 */
	public function sqlDistanceFunction($lat1 = 0, $lon1 = 0, $lat2 = 0, $lon2 = 0) {
		// convert lat1 into radian
		$lat1rad = deg2rad($lat1);

		// convert lat2 into radian
		$lat2rad = deg2rad($lat2);

		// apply the spherical law of cosines to our latitudes and longitudes,
		// and set the result appropriately
		// 6378.1 is the approximate radius of the earth in kilometres
		return acos(
			sin($lat1rad) * sin($lat2rad) +
			cos($lat1rad) * cos($lat2rad) * cos(deg2rad($lon2) - deg2rad($lon1))
		) * 6378.1;
	}

	/**
	 * Create the Database Admin Web Interface
	 *
	 * @since 1.0
	 * @param string $task Task to execute.
	 * @return string Database Admin Webinterface
	 */
	private function DBAdmin($task = "index") {
		// Rewrite header to text/html utf8
		header("Content-type: text/html; charset=ut8");

		// Get minified layout
		$adminTemplate = file_get_contents("Data/Admin/layout.html");

		// Replace title
		$adminTemplate = preg_replace(
			// Replace {%Title%}
			"/{%Title%}/",

			// With
			$task,

			// In admin template
			$adminTemplate
		);

		// Checks if admin is logged in
		if ($this->isAdmin) {
			// Admin is logged in

			// Replace {%inOut%} to out (Logout)
			$adminTemplate = preg_replace(
				// Replace {%inOut%}
				"/{%inOut%}/",

				// With
				"out",

				// In admin template
				$adminTemplate
			);
		} else {
			// Admin is not logged in

			// Replace {%inOut%} to in (Login)
			$adminTemplate = preg_replace(
				// Replace {%inOut%}
				"/{%inOut%}/",

				// With
				"in",

				// In admin template
				$adminTemplate
			);

			// Hide administration links
			$adminTemplate = preg_replace(
				// Replace {%USER_LOGGEDIN%}
				"/{%USER_LOGGEDIN%}(?s).*{%END_USER_LOGGEDIN%}/mi",

				// With
				"",

				// In admin template
				$adminTemplate
			);
		}

		// Replace BaaS_Version
		$adminTemplate = preg_replace(
			// Replace {%BaaS_Version%}
			"/{%BaaS_Version%}/",

			// With
			$this->version,

			// In admin template
			$adminTemplate
		);

		// Replace BaaS_Build
		$adminTemplate = preg_replace(
			// Replace {%BaaS_Build%}
			"/{%BaaS_Build%}/",

			// With
			$this->build,

			// In admin template
			$adminTemplate
		);

		// Replace BaaS_API_Version
		$adminTemplate = preg_replace(
			// Replace {%BaaS_API_Version%}
			"/{%BaaS_API_Version%}/",

			// With
			$this->APIVer,

			// In admin template
			$adminTemplate
		);

		// create a search array
		$search = array(
			// strip whitespaces after tags, except space
			'/\>[^\S ]+/s',

			// strip whitespaces before tags, except space
			'/[^\S ]+\</s',

			// shorten multiple whitespace sequences
			'/(\s)+/s',

			// Remove HTML comments
			'/<!--(.|\s)*?-->/',

			// Remove all spaces after and before elements
			'/\s?(,|:|;|>|}|{|>|<)\s?/',
		);

		// create a replace array
		$replace = array(
			// strip whitespaces after tags, except space
			'>',

			// strip whitespaces before tags, except space
			'<',

			// shorten multiple whitespace sequences
			'\\1',

			// Remove HTML comments
			'',

			// Remove all spaces after and before elements
			'\\1',
		);

		// Minify template and return.
		$adminTemplate = preg_replace(
			// the search array
			$search,

			// the replace array
			$replace,

			// In admin template
			$adminTemplate
		);

		// Replace Contents
		$adminTemplate = preg_replace(
			// Replace {%Contents%}
			"/{%Contents%}/",

			// With...
			"Welcome Database Admin ($task).",

			// In admin template
			$adminTemplate
		);

		// Return admin template
		return $adminTemplate;
	}

	/**
	 * Is the current user a admin?
	 *
	 * @since 1.0
	 * @param bool $destroy Destroy session?
	 * @return bool Logged in state
	 */
	private function isLoggedInAsAdmin($destroy = false) {
		// Start session, if not already started
		session_start();

		// Need to destroy?
		if ($destroy) {
			// Check if a login token exists
			if (isset($_SESSION['adminUserLoggedToken'])) {
				// Destroy it.
				unset($_SESSION['adminUserLoggedToken']);
			}

			// Destroy session
			session_destroy();
		}

		// Check if a login token exists
		if (isset($_SESSION['adminUserLoggedToken'])) {
			// Check if the token isn't empty
			if (!empty($_SESSION['adminUserLoggedToken'])) {
				// user is Logged in
				return true;
			}
		}

		// Not logged in
		return false;
	}

	/**
	 * SQL Query with parameters
	 *
	 * @since 1.0
	 * @param string $query Query text
	 * @param array|string $parameters Query parameters
	 * @return bool Query executed
	 */
	protected function queryWithParameters($query, $parameters) {
		// Get the table from the SQL Query.
		$table = $this->tableFromSQLString($query);

		// Check if table exists...
		if (!$this->tableExists($table)) {
			// Return the object
			return (object) array(
				// Send Status
				"status" => "Failed",

				// Send error
				"error" => sprintf(
					// Table ... does not exists
					"Table \"%s\" does not exists",

					// tableName
					$table
				),

				// Send table
				"Table" => $table,

				// Send request uri
				"reqURI" => $_SERVER['REQUEST_URI'],

				// Debug
				"debug" => (
					$this->debugmode
					? array(
						"Query" => $query,
						"Parameters" => $parameters,
						"Extracted table from Query" => $table,
					)
					: "Debugmode disabled"
				),
			);
		}

		// If the database type is SQLite then
		if ($this->dbConfig['type'] == "sqlite") {
			// Append our custom function
			$this->db->sqliteCreateFunction(
				// Distance
				'DISTANCE',

				// Distance calculation function
				'BaaS\Server::sqlDistanceFunction',

				// Custom function expect 4 parameters
				4
			);
		}

		try {
			/**
			 * Prepared statement
			 * @var $stmt callable SQL Statement
			 */
			$stmt = $this->db->prepare($query);
		} catch (PDOException $e) {
			// Handle the exception
			return (object) $this->handleException($e, true);
		}

		/**
		 * Walk trough parameters
		 */
		foreach ($parameters as $bindKey => $bindValue) {
			/**
			 * Bind values
			 */
			$stmt->bindValue(
				// :key
				$bindKey,

				// value
				$bindValue,

				// Type (Only text supported right now)
				(
					// Which TYPE
					$this->dbConfig['type'] == "sqlite"

					// SQLite
					 ? SQLITE3_TEXT

					// MySQL
					 : \PDO::PARAM_STR
				)
			);
		}

		try {
			/**
			 * Executed statement
			 * @var $stmt callable SQL Statement
			 */
			@$stmt->execute();

			/**
			 * fetched content
			 * @var [string]
			 */
			// Check if we have a 'select' query.
			if (
				// Are we 'select'-ing
				preg_match(
					// match 'select'
					"/select/",

					// String to lowercase
					strtolower(
						// the SQL Query
						$query
					)
				)
			) {
				// Return the data
				$fetchedData = @$stmt->fetchAll();
			} else {
				// Return the Object.
				return (object) array(
					// Send Status
					"status" => "Success",

					// :)
					"executed" => ($this->debugmode ? $query : true),

					// RowID
					"rowID" => $this->db->lastInsertId(),
				);
			}
		} catch (PDOException $e) {
			// Handle the exception
			return (object) $this->handleException($e, true);
		}

		/**
		 * data check, If less then 1
		 * then skip.
		 */
		if (sizeof($fetchedData) > 1) {
			/**
			 * We've got values
			 */

			if (sizeof($fetchedData) > 2) {
				$fetchedData['values'] = $fetchedData;
				$newArray = array();
				// Remove numeric fields
				foreach ($fetchedData['values'] as $key => $value) {
					// Check if the key is numeric
					if (is_numeric($key)) {
						// Unset, we don't need it
						if (isset($fetchedData['values'][$key])) {
							$tArr = $fetchedData['values'][$key];
							foreach ($tArr as $key => $value) {
								if (is_numeric($key)) {
									unset($tArr[$key]);
								}
							}
							$newArray[] = $tArr;
							unset($fetchedData['values'][$key]);
						}
					}
				}
				$fetchedData['values'] = $newArray;
			}

			// Remove numeric fields
			foreach ($fetchedData as $key => $value) {
				// Check if the key is numeric
				if (is_numeric($key)) {
					// Unset, we don't need it
					// Unset, we don't need it
					unset($fetchedData[$key]);
				}
			}

			// Set status to ok
			$fetchedData['status'] = 'Ok';

			// Return query if in debugmode
			$fetchedData['query'] = ($this->debugmode) ? $query : 'hidden';

			// Return parameters if in debugmode
			$fetchedData['parameters'] = ($this->debugmode) ? $parameters : 'hidden';

			// Return the array
			return (object) $fetchedData;
		}

		/**
		 * Didn't got values
		 * Retry in another way
		 */

		/**
		 * Query
		 * @var string
		 */
		$newQuery = $query;

		/**
		 * Parameter values
		 * @var array
		 */
		$values = array();

		/**
		 * Walk trough parameters
		 */
		foreach ($parameters as $bindKey => $bindValue) {
			/**
			 * Replace parameter bindings :parameter to ?
			 * @var string
			 */
			// Create a new Query
			$newQuery = preg_replace(
				// :bindKey
				'/:' . $bindKey . '/',

				// to ?
				'?',

				// In new Query
				$newQuery,

				// one time
				1,

				// Count
				$count
			);

			// Append parameter values!
			$values[] = $bindValue;
		}

		/**
		 * Prepare for the second time
		 * @var [type]
		 */
		try {
			// Prepare statements
			$new = $this->db->prepare($newQuery);
		} catch (PDOException $e) {
			// Handle the exception
			return (object) $this->handleException($e, true);
		}

		/**
		 * Execute with parameter values
		 */
		$new->execute($values);

		/**
		 * Fetch contents
		 * @var [string]
		 */
		// Fetch data
		$fetchedData = $new->fetch(\PDO::FETCH_BOTH);

		// Check if fetched data exists
		if (isset($fetchedData)) {
			// If size is more then 0
			if (sizeof($fetchedData) > 1) {
				// Remove numeric fields
				foreach ($fetchedData as $key => $value) {
					// Check if the key is numeric
					if (is_numeric($key)) {
						// Unset, we don't need it
						unset($fetchedData[$key]);
					}
				}

				// Set status to ok
				$fetchedData['status'] = 'Ok';

				// Return query if in debugmode
				$fetchedData['query'] = ($this->debugmode) ? $query : 'hidden';

				// Return parameters if in debugmode
				$fetchedData['parameters'] = ($this->debugmode) ? $parameters : 'hidden';

				// Objectify
				return (object) $fetchedData;
			}
		}

		if (
			// Are we 'select'-ing
			preg_match(
				// match 'select'
				"/select/",

				// String to lowercase
				strtolower(
					// the SQL Query
					$query
				)
			)
		) {
			// Failed, or no data found.
			return (object) array(
				// Status failed
				"status" => "Failed",

				// Warning
				"warning" => "Failed to execute query",

				"query" => $query,

				"newQuery" => isset($newQuery) ? $newQuery : '',
			);
		}

		// Failed, or no data found.
		return (object) array(
			// Status failed
			"status" => "Success",

			// Warning
			"warning" => "Executed query",
		);
	}

	/**
	 * Fix for Travis CI
	 * @return array empty.
	 */
	public function __sleep() {
		// FIX TRAVIS
		return array();
	}

	/**
	 * Fix for Travis CI
	 * @return void
	 */
	public function __wakeup() {
		// If there is defined a DATABASE_TYPE
		if (!empty($this->dbConfig['type'])) {
			// If it is SQLite and there is a $this->dbConfig['path']
			if (
				// If the database type is SQLite
				$this->dbConfig['type'] == "sqlite"

				// And the path is not empty
				 && !empty($this->dbConfig['path'])
			) {
				try {
					// Try to create/load a SQLite database
					$this->db = new \PDO(
						// sqlite:DBName.sqlite
						sprintf(
							// sqlite:DBName.sqlite
							'sqlite:%s',

							// Database Path
							$this->dbConfig['path']
						)
					);

					// Set the error mode
					$this->db->setAttribute(
						// Set the error mode
						\PDO::ATTR_ERRMODE,

						// To Trow Exceptions.
						\PDO::ERRMODE_EXCEPTION
					);
				} catch (PDOException $e) {
					// Handle the exception
					return $this->handleException($e);
				}
			}
		}
	}

	/**
	 * Create row
	 *
	 * @parameter string $tableName the table name
	 * @parameter bool $asJSON as JSON string?
	 * @return array|string Fieldnames
	 */
	private function rowCreate($action) {
		// row.create
		// Check if the table exists
		if (!$this->tableExists($action)) {
			// Return a error, it does not exists.
			return json_encode(
				array(
					// Send Status
					"status" => "Failed",

					// Table ... does not exists
					"error" => sprintf(
						// Table ... does not exists
						"Table \"%s\" does not exists",

						// Table name
						$table
					),

					// Table
					"Table" => $table,

					// Request
					"reqURI" => $_SERVER['REQUEST_URI'],
				)
			);
		}

		// Check if we got some data
		if (!isset($_POST['JSON'])) {
			// Return a error
			return json_encode(
				array(
					// Send Status
					"status" => "Failed",

					// No JSON
					"error" => "Please post JSON",

					// No JSON
					"fix" => "Post JSON",
				)
			);
		}

		/**
		 * @var mixed JSON Data
		 */
		$decodedJSON = json_decode($_POST['JSON'], true);

		// Check if we have undecoded the JSON
		if (
			// Is not is an array
			!is_array($decodedJSON) ||

			// And size is less than 1
			sizeof($decodedJSON) < 1
		) {
			// Could not decode
			return json_encode(
				array(
					// Send Status
					"status" => "Failed",

					// Error message
					"error" => "Please post valid JSON",

					// Fix
					"fix" => "Failed to decode JSON",
				)
			);
		}

		// Insert info ..
		$sqlQuery = sprintf(
			// Insert into
			"INSERT INTO `%s` (",

			// Escape the database
			$this->escapeString(
				// Replace insecure fields
				preg_replace(
					// `
					"/`/",

					// to \\`
					"\\`",

					// in $databaseName
					$action
				)
			)
		);

		// Create empty string for values
		$SQLValues = "";

		// Get the current table fields / columns
		$tableFields = $this->getTableFields($action);

		// Comparing fields.
		for ($i = 0; $i < sizeof($tableFields); $i++) {
			// If not exists field, and may not be ignored
			if (
				// If the field does not exists
				!isset($decodedJSON['values'][$tableFields[$i]]) &&

				// And not in the default fields array.
				!in_array(
					// Fieldname
					$tableFields[$i],

					// Default fields
					$this->defaultFields
				)
			) {
				// Return the error
				return json_encode(
					// Array
					array(
						// Send Status
						"status" => "Failed",

						// Send error message
						"error" => "Missing required parameter",

						// Send missing parameter
						"parameter" => $tableFields[$i],

						// Send how to fix
						"fix" => sprintf(
							// Provide parameter ...
							"Provide parameter \"%s\".",

							// Missing parameter name
							$tableFields[$i]
						),
					)
				);
			} else {
				// Check if field is not ID
				if ($tableFields[$i] != 'id') {
					// Append to SQL command string
					$sqlQuery .= sprintf(
						// `...`
						"`%s`, ",

						// Fieldname
						$tableFields[$i]
					);

					// Append to value string
					$SQLValues .= sprintf(
						// '...'
						"%s%s%s, ",

						// Check if the value is numeric
						(
							// Is it numeric?
							is_numeric($decodedJSON['values'][$tableFields[$i]])

							// It's numeric
							 ? ''

							// It's a value, so we must escape it
							 : '\''
						),

						// Value
						$this->escapeString(
							// Replace possible dangerous strings
							preg_replace(
								// Replace '
								"/'/",

								// With \'
								"\\'",

								// In JSONData[values][field]
								$decodedJSON['values'][$tableFields[$i]]
							)
						),

						// Check if the value is numeric
						(
							// Is it numeric?
							is_numeric($decodedJSON['values'][$tableFields[$i]])

							// It's numeric
							 ? ''

							// It's a value, so we must escape it
							 : '\''
						)
					);
				}
			}
		}

		// INSERT INTO ... (....) VALUES (....);
		$sqlQuery = sprintf(
			// Create the string
			"%s) VALUES (%s);",

			// Remove the extra ", " (2 characters) so 0, -2
			substr($sqlQuery, 0, -2),

			// Remove the extra ", " (2 characters) so 0, -2
			substr($SQLValues, 0, -2)
		);

		// Run the query
		$action = $this->db->query($sqlQuery);

		// Get the row ID
		$insertID = $this->db->lastInsertId();

		// Check if insertion passed
		if ($action) {
			// Return
			return json_encode(
				// Array
				array(
					// Send Status
					"status" => "Success",

					// Send info
					"info" => "Row inserted",

					// Send RowID
					"rowID" => $insertID,
				)
			);
		}

		// Failed...
		return json_encode(
			// Array
			array(
				// Send Status
				"status" => "Failed",

				// Send Error message
				"error" => "Could not insert row",

				// Send how-to-fix
				"fix" => "Please try again later",

				// Append debug fields (if debugmode is true)
				"debug" => ($this->debugmode ? $sqlQuery : 'Off'),
			)
		);
	}

	/**
	 * Get table fields (columns)
	 *
	 * @parameter string $tableName the table name
	 * @parameter bool $asJSON as JSON string?
	 * @return array|string Fieldnames
	 */
	protected function getTableFields($tableName, $asJSON = false) {
		// Create a empty array
		$fields = array();

		// our SQL query
		$sqlQuery = sprintf(
			// Query
			"SHOW columns from `%s`;",

			// Replace %s with tableName
			$this->escapeString(
				// Escape `
				preg_replace(
					// Replace `
					"/`/",

					// With \`
					"\\`",

					// in
					$tableName
				)

			)
		);

		// Run query.
		$rawFields = $this->db->query($sqlQuery)->fetchAll();

		// Walk trough the values
		for ($i = 0; $i < sizeof($rawFields); $i++) {
			// Append value to fields
			$fields[] = $rawFields[$i][0];
		}

		// Return the fields as json or array
		return (
			// As JSON?
			$asJSON

			// AS JSON
			 ? json_encode($fields)

			// AS Array
			 : $fields
		);
	}

	/**
	 * Creates a Shared Instance
	 *
	 * @return callable Instance
	 */
	public static function shared() {
		/**
		 * @var mixed
		 */
		static $inst = null;

		// Check if we don't have a instance already
		if ($inst === null) {
			// Create the instance
			$inst = new \BaaS\Server();
		}

		// Return our instance
		return $inst;
	}

	/**
	 * Construct the class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		// Get the HTTP Protocol
		$this->protocol = (
			// Did we got the protocol?
			isset($_SERVER['SERVER_PROTOCOL'])

			// Yes, return it
			 ? $_SERVER['SERVER_PROTOCOL']

			// We'll make a common one
			 : 'HTTP/1.1'
		);

		// Create a temporary array
		$checkWritePermissions = explode(
			// "/"
			"/",

			// The file.
			$this->BFfile
		);

		// Create a empty string
		$this->blockFilePath = "";

		// Loop trough the temporary array -1
		for ($i = 0; $i < (sizeof($checkWritePermissions) - 1); $i++) {
			// Append to the this->blockFilePath.
			$this->blockFilePath .= sprintf(
				// ".../"
				"%s/",

				// Block file path
				$checkWritePermissions[$i]
			);
		}

		// If there is a / in the begin, place it back.
		if (substr($this->BFfile, 0, 1) == "/") {
			// Append / in the beginning, and overwrite path
			$this->blockFilePath = sprintf(
				// "/..."
				"/%s",

				// Block file path
				$blockFilePath
			);
		}

		// X-Powered-By: BaaS/version
		// Overwrite PHP
		header(
			sprintf(
				// X-Powered-By: BaaS/...
				"X-Powered-By: BaaS/%s (https://github.com/wdg/BaaS)",

				// API Version
				$this->APIVer
			)
		);

		// Set the content type
		header("Content-type: application/json; charset=UTF-8");

		// Do not sniff (change) our content type ever
		header("X-Content-Type-Options: nosniff");

		// Protect XSS
		header("X-XSS-Protection: 1; mode=block");

		// Disable prefetch
		header("X-DNS-Prefetch-Control: off");

		// Don't give our referer ever
		header("Referrer-Policy: no-referrer");

		// Expire page after 10 seconds.
		header(
			sprintf(
				// Expire after %s
				"Expires: %s",

				// %s = current time + 10 seconds
				gmdate(
					// ISO Time
					'D, d M Y H:i:s \G\M\T',

					// Time + 10 seconds
					time() + 10
				)
			)
		);

		// Disable caching
		header("Cache-Control: no-cache");

		// Close the connection immediately
		header("Connection: close");

		// Set the "Block" file
		$this->BFfile = sprintf(
			// Block file
			$this->BFfile,

			// Replace %s with current IP-Address
			$_SERVER['REMOTE_ADDR']
		);

		// Checks isAdmin state
		$this->isAdmin = $this->isLoggedInAsAdmin();

		// Load Extensions (if exists)
		foreach (glob("Data/Extensions/*_extension.php") as $extension) {
			// Is the file readable?
			if (is_readable($extension)) {
				// Load the file
				include_once $extension;
			}
		}

		// Great
		$protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
		$reqURI = explode("index.php", $_SERVER['PHP_SELF'])[0];

		$this->BaaSAddress = sprintf(
			'%s%s%s',
			$protocol,
			$_SERVER['HTTP_HOST'],
			$reqURI
		);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (!isset($_POST['JSON'])) {
				$json_params = @urldecode(
					@file_get_contents("php://input")
				);

				@json_decode($json_params); // ignore all errors, since it is a check.

				if (json_last_error() == JSON_ERROR_NONE) {
					$_POST['JSON'] = $json_params;
				}
			}
		}
	}

	/**
	 * Is the server available?
	 *
	 * @since 1.0
	 * @param string $serverAddr Server address
	 * @return mixed|string Offline/Online
	 */
	protected function isTheServerAvailable($serverAddr) {
		// Connect to the MySQL Server
		$fp = fsockopen($serverAddr, 3306, $errno, $errstr);

		// Return offline, or online
		return (!$fp ? 'Offline' : 'Online');
	}

	/**
	 * Deal with exceptions.
	 *
	 * @since 1.0
	 * @param callable $exception throwed exception
	 * @return mixed|string JSON String with error (if available)
	 */
	protected function handleException($exception) {
		// This is a PDO Exception
		if ($exception instanceof PDOException) {
			// Return the error in JSON
			return json_encode(
				// Array
				array(
					// Send Status
					"status" => "Failed",

					// Show error message
					"error" => "PDOException happend!",

					// Show the exception
					"exception" => $exception->getMessage(),
				)
			);
		}

		// This is a Normal Exception
		if ($exception instanceof Exception) {
			// Return the error in JSON
			return json_encode(
				// Array
				array(
					// Send Status
					"status" => "Failed",

					// Show error message
					"error" => "Exception happend!",

					// Show the exception
					"exception" => $exception->getMessage(),
				)
			);
		}

		// This is Exceptional...
		return json_encode(
			// Return the error in JSON
			array(
				// Send Status
				"status" => "Failed",

				// Show error message
				"error" => "Uncought exception!",

				// Show the exceptional message
				"exception" => $exception,
			)
		);
	}

	/**
	 * Set the HTTP Status Code
	 *
	 * @since 1.0
	 * @param int $code HTTP Status Code
	 */
	protected function setHTTPStatusCode($code = 200, $returnAsText = false) {
		// Set http code.
		switch ($code) {
		case 100:
			// Set the HTTP Status text
			$text = 'Continue';
			break;
		case 101:
			// Set the HTTP Status text
			$text = 'Switching Protocols';
			break;
		case 200:
			// Set the HTTP Status text
			$text = 'OK';
			break;
		case 201:
			// Set the HTTP Status text
			$text = 'Created';
			break;
		case 202:
			// Set the HTTP Status text
			$text = 'Accepted';
			break;
		case 203:
			// Set the HTTP Status text
			$text = 'Non-Authoritative Information';
			break;
		case 204:
			// Set the HTTP Status text
			$text = 'No Content';
			break;
		case 205:
			// Set the HTTP Status text
			$text = 'Reset Content';
			break;
		case 206:
			// Set the HTTP Status text
			$text = 'Partial Content';
			break;
		case 300:
			// Set the HTTP Status text
			$text = 'Multiple Choices';
			break;
		case 301:
			// Set the HTTP Status text
			$text = 'Moved Permanently';
			break;
		case 302:
			// Set the HTTP Status text
			$text = 'Moved Temporarily';
			break;
		case 303:
			// Set the HTTP Status text
			$text = 'See Other';
			break;
		case 304:
			// Set the HTTP Status text
			$text = 'Not Modified';
			break;
		case 305:
			// Set the HTTP Status text
			$text = 'Use Proxy';
			break;
		case 400:
			// Set the HTTP Status text
			$text = 'Bad Request';
			break;
		case 401:
			// Set the HTTP Status text
			$text = 'Unauthorized';
			break;
		case 402:
			// Set the HTTP Status text
			$text = 'Payment Required';
			break;
		case 403:
			// Set the HTTP Status text
			$text = 'Forbidden';
			break;
		case 404:
			// Set the HTTP Status text
			$text = 'Not Found';
			break;
		case 405:
			// Set the HTTP Status text
			$text = 'Method Not Allowed';
			break;
		case 406:
			// Set the HTTP Status text
			$text = 'Not Acceptable';
			break;
		case 407:
			// Set the HTTP Status text
			$text = 'Proxy Authentication Required';
			break;
		case 408:
			// Set the HTTP Status text
			$text = 'Request Time-out';
			break;
		case 409:
			// Set the HTTP Status text
			$text = 'Conflict';
			break;
		case 410:
			// Set the HTTP Status text
			$text = 'Gone';
			break;
		case 411:
			// Set the HTTP Status text
			$text = 'Length Required';
			break;
		case 412:
			// Set the HTTP Status text
			$text = 'Precondition Failed';
			break;
		case 413:
			// Set the HTTP Status text
			$text = 'Request Entity Too Large';
			break;
		case 414:
			// Set the HTTP Status text
			$text = 'Request-URI Too Large';
			break;
		case 415:
			// Set the HTTP Status text
			$text = 'Unsupported Media Type';
			break;
		case 500:
			// Set the HTTP Status text
			$text = 'Internal Server Error';
			break;
		case 501:
			// Set the HTTP Status text
			$text = 'Not Implemented';
			break;
		case 502:
			// Set the HTTP Status text
			$text = 'Bad Gateway';
			break;
		case 503:
			// Set the HTTP Status text
			$text = 'Service Unavailable';
			break;
		case 504:
			// Set the HTTP Status text
			$text = 'Gateway Time-out';
			break;
		case 505:
			// Set the HTTP Status text
			$text = 'HTTP Version not supported';
			break;
		default:
			// Set the HTTP Status code
			$code = 200;

			// Set the HTTP Status text
			$text = 'OK';
			break;
		}

		if ($returnAsText) {
			return $text;
		}

		// set response code
		if (function_exists('http_response_code')) {
			// set response code
			http_response_code($code);
		} else {
			// set response code
			// Fallback for older servers.
			header(
				// PROTOCOL CODE TEXT
				"%s %s %s",

				// Protocol
				$this->protocol,

				// HTTP-Code
				$code,

				// HTTP-Text
				$text
			);
		}
	}

	/**
	 * Diagnosis for problems
	 *
	 * @since 1.0
	 */
	private function diagnosis($key) {
		//"/diag", "/diagnose", "/diagnostics"

		// If the URL matches the API-Key
		if ($this->APIKey === $key) {
			// Create a information array (and yes it contains a lot of information)
			$information = (
				// Create the array
				array(
					// Section: Server Information
					"Server Information" => array(
						// Get the version of the PHP instance which is running
						"PHP Version" => phpversion(),

						// Get Webserver details
						"Webserver" => @$_SERVER['SERVER_SOFTWARE'],

						// Get Gateway interface
						"Gateway Interface" => @$_SERVER['GATEWAY_INTERFACE'],

						// Get the server's IP-Address
						"Server IP" => @$_SERVER['SERVER_ADDR'],

						// Get the server's name
						"Server name" => @$_SERVER['SERVER_NAME'],

						// Get the document root.
						"Document Root" => @$_SERVER['DOCUMENT_ROOT'],
					),

					// Section: BaaS Information
					"BaaS Information" => array(
						// Get Baas version information
						"Version" => array(
							// BaaS Version number
							"Version" => $this->version,

							// BaaS Build number
							"Build" => $this->build,

							// BaaS API Version
							"API Version" => $this->APIVer,
						),

						// Get Database configuration (without passwords!)
						"Database Configuration" => array(
							// Which server type we are using?
							"Server Type" => $this->dbConfig['type'],

							// Which path are we using
							"Server Path" => $this->dbConfig['path'],

							// Which host we are connecting to
							"Server Host" => $this->dbConfig['host'],

							// Hi, database, what's your name?
							"Server Database name" => $this->dbConfig['name'],

							// Hi, i'm ...
							"Server Username" => $this->dbConfig['user'],

							// Do we have a connection?
							"Server Available" => (
								// Does the database resource path exixists?
								isset($this->db)

								// Yes, we have a super special connection
								 ? 'Yes'

								// Nope, I miss you!
								 : 'No'
							),
						),

						// Get some other configuration
						// BaaS Parameters
						"BaaS Configuration" => array(
							// Are we in debugmode right now?
							'debugmode' => $this->debugmode,

							// Is autotranslation on?
							'translate' => $this->translate,

							// What is the API Key?
							"apiKey" => $this->APIKey,

							// How many times i can try?
							'triesMaximum' => $this->triesMaximum,

							// And how long i will be blocked?
							'triesTime' => $this->triesTime,

							// And where are you saving that information?
							'BFfile' => $this->BFfile,

							// And where is that?
							'blockFilePath' => $this->blockFilePath,

							// Am i a administrator?
							'isAdmin' => $this->isAdmin,

							// Are we on a commandline interface (CLI)?
							'isCLI' => $this->isCLI,

							// Did i make a error?
							'error' => $this->error,

							// Oh, and what was wrong?
							'errorMessage' => $this->errorMessage,

							// Do you save files to your database?
							'saveFilesToDatabase' => $this->saveFilesToDatabase,

							// And what is your default protocol for talking with me?
							'protocol' => $this->protocol,

							// What are the default http status/error codes?
							'errorCode' => array(
								"blocked" => array(
									"code" => $this->errorCode['blocked'],
									"message" => $this->setHTTPStatusCode($this->errorCode['blocked'], true),
								),
								"invalidRequest" => array(
									"code" => $this->errorCode['invalidRequest'],
									"message" => $this->setHTTPStatusCode($this->errorCode['invalidRequest'], true),
								),
								"ok" => array(
									"code" => $this->errorCode['ok'],
									"message" => $this->setHTTPStatusCode($this->errorCode['ok'], true),
								),
							),

							// What defaults field are you using in your database?
							'defaultFields' => $this->defaultFields,

							// What defaults tables are you using in your database?
							'defaultTables' => $this->defaultTables,

							// Which extensions are loaded, and which you have found?
							'extensions' => array(
								// Loaded extensions (they are handled below)
								"loaded" => array(),

								// Found extensions (they are handled below)
								"found" => array(),
							),
						),
					),

					// Section: Client Information
					"Client Information" => array(
						// What is the IP-Address of the client?
						"IP-Address" => @$_SERVER['REMOTE_ADDR'],

						// What is their name?
						"Hostname" => (
							// Is REMOTE_HOST defined?
							isset($_SERVER['REMOTE_HOST'])

							// Yes, but is it empty?
							 ? (!empty($_SERVER['REMOTE_HOST'])

								// Not empty, so we can use it
								 ? @$_SERVER['REMOTE_HOST']

								// Get the hostname by the REMOTE_ADDR
								 : gethostbyaddr(@$_SERVER['REMOTE_ADDR'])
							)

							// Get the hostname by the REMOTE_ADDR
							 : gethostbyaddr($_SERVER['REMOTE_ADDR'])
						),

						// Which protocol is used to talk?
						"HTTP Protocol" => @$_SERVER['SERVER_PROTOCOL'],

						// Which method is used?
						"HTTP Method" => @$_SERVER['REQUEST_METHOD'],

						// At what time?
						"Request Time" => @$_SERVER['REQUEST_TIME'],

						// And what is requested?
						"Requested URL" => @$_SERVER['REQUEST_URI'],

						// Do you have Cookies?
						"Cookies" => $_COOKIE,

						// And are you already in a session?
						"Session" => $_SESSION,

						// What answers does the client accept?
						"HTTP Accept" => @$_SERVER['HTTP_ACCEPT'],

						// And which character sets are supported?
						"HTTP Accept Charset" => @$_SERVER['HTTP_ACCEPT_CHARSET'],

						// Ok, and about the encoding?, i'll preffer utf8
						"HTTP Accept Encoding" => @$_SERVER['HTTP_ACCEPT_ENCODING'],

						// And what language does the client speak?
						"HTTP Accept Language" => @$_SERVER['HTTP_ACCEPT_LANGUAGE'],

						// HTTP Connection?
						"HTTP Connection" => @$_SERVER['HTTP_CONNECTION'],

						// Which name you called me (the server)
						"HTTP Host" => @$_SERVER['HTTP_HOST'],

						// Where are you from?
						"HTTP Referer" => @$_SERVER['HTTP_REFERER'],

						// What's your user agent?
						"HTTP User Agent" => @$_SERVER['HTTP_USER_AGENT'],

						// Are you using HTTPS?
						"HTTPS" => @$_SERVER['HTTPS'],
					),
				)
			);

			// Walk trough the loaded extensions
			for ($i = 0; $i < sizeof($this->extensions); $i++) {
				// Append information to 'BaaS Information' -> 'BaaS Configuration' -> 'extensions' -> 'loaded'
				$information['BaaS Information']['BaaS Configuration']['extensions']['loaded'][] = array(
					// Extension url name/call
					"Extension URL" => $this->extensions[$i][0],

					// Which underlaying function
					"Function Call" => $this->extensions[$i][1],

					// Do you require a valid API-key?
					"APIKey Required" => $this->extensions[$i][2],
				);
			}

			// Get possible extensions
			foreach (glob("Data/Extensions/*_extension.php") as $extension) {
				// Is the file readable?
				if (is_readable($extension)) {
					// Append information to 'BaaS Information' -> 'BaaS Configuration' -> 'extensions' -> 'found'
					$information['BaaS Information']['BaaS Configuration']['extensions']['found'][] = array(
						// Extension filename
						"file" => $extension,

						// Extension filesize
						"size" => filesize($extension) . ' bytes',

						// md5 hash of the file
						"md5" => md5(
							// Get file contents
							file_get_contents(
								// Extension filename
								$extension
							)
						),
					);
				}
			}

			// Return all the information as JSON
			return json_encode(
				// Information array
				$information
			);
		}

		// Count up invalid attempts
		// If there are to many attempts, this user will be blocked.
		$this->setAttempt($_SERVER['REMOTE_ADDR']);

		// Invalid API-Key,
		// Throw a exception
		return $this->handleException('Invalid APIKey');
	}
}
