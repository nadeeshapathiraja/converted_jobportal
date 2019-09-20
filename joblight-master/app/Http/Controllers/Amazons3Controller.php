<?php
namespace app\Http\Controllers;
use App\Http\Controllers\Controller;

use Config;
use Aws\S3\S3Client;
use Aws\Common\Credentials\Credentials;

Class Amazons3Controller extends Controller {  
	
	public $bucket, $credentials, $region;

    public function __construct() {
        /*
        $this->bucket = Config::get('filesystems.disks.s3.bucket');
        $this->region = Config::get('filesystems.disks.s3.region');
    	$this->credentials = new Credentials(Config::get('filesystems.disks.s3.key'), 
    										 Config::get('filesystems.disks.s3.secret')); 
		*/
    	$this->bucket = env('AS3_bucket');
        $this->region = env('AS3_region');
    	$this->credentials = new Credentials(env('AS3_key'), env('AS3_secretkey')); 
  
    }	

	public function uploadObj($data){	
		try{
			// Instantiate the S3 client with your AWS credentials
			$client = S3Client::factory(array(
			    'credentials' => $this->credentials
			));

			if(!empty($data['Bucket']) && $data['Bucket'] != $this->bucket) {	
				$createBucket = true;
				//check if bucket already exist
				$result = $client->listBuckets();
				foreach ($result['Buckets'] as $bucket) {			    
				    if( $bucket['Name'] == $data['Bucket']) $createBucket = false;
				}

				if($createBucket){				
					$client->createBucket(array('Bucket' => $data['Bucket'],
												'region' => $this->region,));
					// Poll the bucket until it is accessible
					$client->waitUntil('BucketExists', array('Bucket' => $data['Bucket']));										
				}
				$this->bucket = $data['Bucket'];
			}

			// Upload an object by streaming the contents of a file
			// $pathToFile should be absolute path to a file on disk
			if(!empty($data['SourceFile'])){
				$result = $client->putObject(array(
				    'Bucket'     => $this->bucket,
				    'Key'        => $data['Key'],
				    'SourceFile' => $data['SourceFile'],
				    'ACL'        => 'public-read',
				    'ContentType' => $data['ContentType'],
				));
			}
			elseif(!empty($data['Body'])){
				$result = $client->putObject(array(
				    'Bucket'     => $this->bucket,
				    'Key'        => $data['Key'],				    
				    'Body'   	 => $data['Body'],
				    'ACL'        => 'public-read',
				    'ContentType' => $data['ContentType'],
				));
			}

			$client->waitUntil('ObjectExists', array(
				'Bucket' =>  $this->bucket,
				'Key'    => $data['Key']
			));

		} catch (\Aws\S3\Exception\S3Exception $e) {
		    // The AWS error code (e.g., )
		    //echo $e->getAwsErrorCode() . "\n";
		    // The bucket couldn't be created
		    //echo $e->getMessage() . "\n";
		    return $e->getMessage();
		}

		// Get the URL the object can be downloaded from
		return($result);

	}

	public function deleteObj($data){	
		try{
			// Instantiate the S3 client with your AWS credentials
			$client = S3Client::factory(array(
			    'credentials' => $this->credentials
			));

			$result = $client->deleteObject(array(			    
			    'Bucket' => $this->bucket,			    
			    'Key' => $data['Key'],
			));

		} catch (\Aws\S3\Exception\S3Exception $e) {
		    return $e->getMessage();
		}		

		return($result);
	}


}

?>