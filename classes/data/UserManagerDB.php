<?php
namespace classes\data;

use classes\entity\User;
use classes\util\DBUtil;

/**
 *
 * @author Khazin
 *
 */
class UserManagerDB
{
    /**
     *
     * @param unknown $row
     * @return \classes\entity\User
     */
    public static function fillUser($row){
        $user = new User();
        $user->id        =$row["id"];
        $user->firstName =$row["firstname"];
        $user->lastName  =$row["lastname"];
        $user->email     =$row["email"];
        $user->password  =$row["password"];
        $user->role      =$row["role"];
    		$user->account_creation_time = $row["account_creation_time"];
        return $user;
    }
    /**
     *
     * @param unknown $email
     * @param unknown $password
     * @return NULL|\classes\entity\User
     */
    public static function getUserByEmailPassword($email, $password){
        $user = NULL;
        $conn = DBUtil::getConnection();
        $email    = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn,$password);
        $sql    = "select * from tb_user where email='$email' and password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if ( $row = $result->fetch_assoc() ) {
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    /**
     *
     * @param unknown $email
     * @return NULL|\classes\entity\User
     */
    public static function getUserByEmail($email){
        $user   = NULL;
        $conn   = DBUtil::getConnection();
        $email  = mysqli_real_escape_string($conn, $email);
        $sql    = "select * from tb_user where Email = '$email'";
        $result = $conn->query($sql);
        if ( $result->num_rows > 0 ) {
            if ( $row = $result->fetch_assoc() ) {
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    /**
     *
     * @param unknown $email
     * @return \classes\entity\User[]
     */
	public static function getUserFnameLnameEmail($email){
        $users[] = array();
        $conn  = DBUtil::getConnection();
        $email = mysqli_real_escape_string($conn, $email);
        $sql   = "select * from tb_user where email like '%$email%'";
        $result = $conn->query($sql);
        if ( $result->num_rows > 0 ) {
            while ( $row = $result->fetch_assoc() ) {
                $user = self::fillUser($row);
                $users[] = $user;
            }
        }
        $conn->close();
        return $users;
    }
    /**
     *
     * @param unknown $id
     * @return NULL|\classes\entity\User
     */

	public static function getUserById($id){
        $user = NULL;
        $conn = DBUtil::getConnection();
        $id = mysqli_real_escape_string($conn, $id);
        $sql = "select * from tb_user where id='$id'";
        $result = $conn->query($sql);
        if ( $result->num_rows > 0 ) {
            if( $row = $result->fetch_assoc() ){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    /**
     *
     * @param User $user
     */
    public static function saveUser(User $user){
        $conn = DBUtil::getConnection();
        $sql  = "call procSaveUser(?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss", $user->id, $user->firstName, $user->lastName, $user->email, $user->password, $user->account_creation_time, $user->role);
        $stmt->execute();
        if( $stmt->errno != 0){
            printf("Error: %s.\n", $stmt->error);
        }
        $stmt->close();
        $conn->close();
    }
    /**
     *
     * @param unknown $email
     * @param unknown $password
     */
    public static function updatePassword($email, $password){
        $conn = DBUtil::getConnection();
        $sql  = "UPDATE tb_user SET password='$password' WHERE email='$email';";
        $stmt = $conn->prepare($sql);
		if ( $conn->query($sql) === TRUE ) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		$conn->close();

    }
    /**
     *
     * @param unknown $id
     */

    public static function deleteAccount($id){
        $conn = DBUtil::getConnection();
        $sql  = "DELETE from tb_user WHERE id='$id';";
        $stmt = $conn->prepare($sql);
		if ( $conn->query($sql) === TRUE) {
			echo "<script>alert(Record deleted successfully)</script>";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		$conn->close();

    }
    /**
     *
     * @return \classes\entity\User[]
     */
    public static function getAllUsers(){
        $users [] = array();
        $conn   = DBUtil::getConnection();
        $sql    = "select * from tb_user";
        $result = $conn->query($sql);
        if ( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ){
                $user    = self::fillUser($row);
                $users[] = $user;
            }
        }
        $conn->close();
        return $users;
    }
}

?>
