<?php
require_once('config.php');
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");
header("content-type:application/json; charset=UTF-8");
//  کوعری 

$d = json_decode(file_get_contents('php://input'), true);
if ($d) {
    $api = $d["type"];
} else {
    $api = null;
}
function access()
{
    $sid = session_id();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new PDO("mysql:host=$servername;dbname=amirkabir_db", $username, $password);
    // set the PDO Exception $error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $input = json_decode(file_get_contents('php://input'), true);
    if ($input["access"] == "modir") {
        $stmt = $conn->prepare("SELECT id, username, password FROM tbl_admin where username = :username and password = :password and ismodir = 1");
        $stmt->bindParam(':username', $input['username']);
        $stmt->bindParam(':password', $input['password']);
        $stmt->execute();
        // set the resulting array to associative
        $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result1) {
            $stmt = $conn->prepare("SELECT sid FROM tbl_sid where adminid = :userid");
            $stmt->bindParam(':userid', $result1["id"]);
            $stmt->execute();
            // set the resulting array to associative
            $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result11) {
                try {
                    $stmt = $conn->prepare(" UPDATE amirkabir_db.tbl_sid SET sid = :sid where adminid = :userid ");
                    $stmt->bindParam(':sid', $input['sid']);
                    $stmt->bindParam(':userid', $result1["id"]);
                    $stmt->execute();
                    $data = json_encode(["message" => "true", "action" => "update"]);
                } catch (Exception $Exception) {
                    $data = json_encode(["message" => "eror"]);
                }
            } else {
                try {
                    $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_sid (  sid,  adminid) VALUES ( :sid, :userid )");
                    $stmt->bindParam(':sid', $input['sid']);
                    $stmt->bindParam(':userid', $result1["id"]);
                    $stmt->execute();
                    $data = json_encode(["message" => "true", "action" => "add"]);
                } catch (Exception $error) {
                    $data = json_encode(["message" => "eror"]);
                }
            }
        } else {
            $data = json_encode(["message" => "false"]);
        }
    } elseif ($input["access"] == "dabir") {
        $stmt = $conn->prepare("SELECT id, username, password FROM tbl_admin where username = :username and password = :password and ismodir = 0");
        $stmt->bindParam(':username', $input['username']);
        $stmt->bindParam(':password', $input['password']);
        $stmt->execute();
        // set the resulting array to associative
        $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result1) {
            $stmt = $conn->prepare("SELECT sid FROM tbl_sid where adminid = :userid");
            $stmt->bindParam(':userid', $result1["id"]);
            $stmt->execute();
            // set the resulting array to associative
            $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result11) {
                try {
                    $stmt = $conn->prepare(" UPDATE amirkabir_db.tbl_sid SET sid = :sid where adminid = :userid ");
                    $stmt->bindParam(':sid', $input['sid']);
                    $stmt->bindParam(':userid', $result1["id"]);
                    $stmt->execute();
                    $data = json_encode(["message" => "true", "action" => "update"]);
                } catch (Exception $error) {
                    $data = json_encode(["message" => "eror"]);
                }
            } else {
                try {
                    $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_sid (  sid,  adminid) VALUES ( :sid, :userid )");
                    $stmt->bindParam(':sid', $input['sid']);
                    $stmt->bindParam(':userid', $result1["id"]);
                    $stmt->execute();
                    $data = json_encode(["message" => "true", "action" => "add"]);
                } catch (Exception $error) {
                    $data = json_encode(["message" => "eror"]);
                }
            }
        } else {
            $data = json_encode(["message" => "false"]);
        }
    } elseif ($input["access"] == "honarjo") {
        $stmt = $conn->prepare("SELECT id, username, password FROM tbl_user where username = :username and password = :password");
        $stmt->bindParam(':username', $input['username']);
        $stmt->bindParam(':password', $input['password']);
        $stmt->execute();
        // set the resulting array to associative
        $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result1) {
            $stmt = $conn->prepare("SELECT sid FROM tbl_sid where userid = :userid");
            $stmt->bindParam(':userid', $result1["id"]);
            $stmt->execute();
            // set the resulting array to associative
            $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result11) {
                try {
                    $stmt = $conn->prepare(" UPDATE amirkabir_db.tbl_sid SET sid = :sid where userid = :userid ");
                    $stmt->bindParam(':sid', $input['sid']);
                    $stmt->bindParam(':userid', $result1["id"]);
                    $stmt->execute();
                    $data = json_encode(["message" => "true", "action" => "update"]);
                } catch (Exception $error) {
                    $data = json_encode(["message" => "eror"]);
                }
            } else {
                try {
                    $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_sid (  sid,  userid) VALUES ( :sid, :userid )");
                    $stmt->bindParam(':sid', $input['sid']);
                    $stmt->bindParam(':userid', $result1["id"]);


                    $stmt->execute();
                    $data = json_encode(["message" => "true", "action" => "add"]);
                } catch (Exception $error) {
                    $data = json_encode(["message" => "eror"]);
                }
            }
        } else {
            $data = json_encode(["message" => "false"]);
        }
    }
    return $data;
}
function checkQuizAccess($quizId, $sid)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new PDO("mysql:host=$servername;dbname=amirkabir_db", $username, $password);
    // set the PDO Exception $error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //  ($d['ac'] == "student")
    $adminid = sidsudentchek($sid);
    if ($adminid) {
        // if ($d['on'] == "self") {
        $stmt = $conn->prepare("SELECT tq.id, tq.name title, tq.level, tf.fasl, td.name bookName
                FROM amirkabir_db.tbl_quiz tq 
                    INNER JOIN amirkabir_db.tbl_quiz_user tqu ON ( tq.id = tqu.quiz_id  )  
                        INNER JOIN amirkabir_db.tbl_user tu ON ( tqu.user_id = tu.id  )  
                    INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq.fasl_id = tf.id  )  
                        INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )  
                WHERE tu.id = :id");
        // $stmt = $conn->prepare("SELECT tu.id, tu.fname, tu.lname, tq.name, tq.level, tf.fasl, td.name FROM amirkabir_db.tbl_user tu 	INNER JOIN amirkabir_db.tbl_quiz_user tqu ON ( tu.id = tqu.user_id  )  		INNER JOIN amirkabir_db.tbl_quiz tq ON ( tqu.quiz_id = tq.id  )  			INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq.fasl_id = tf.id  )  				INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )      where tqu.user_id = :id");

        $stmt->bindParam(':id', $adminid[0]['id']);
        $stmt->execute();
        $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result11) {
            $data = $result11;
        } else {
            $data = null;
        }
        // print_r($data);
        // } elseif ($d['on'] == "class") {
        $stmt = $conn->prepare("SELECT tq.id, tq.name title, tq.level, tf.fasl, td.name bookName
                FROM amirkabir_db.tbl_quiz tq 
                    INNER JOIN amirkabir_db.tbl_quiz_class tqc ON ( tq.id = tqc.quiz_id  )  
                        INNER JOIN amirkabir_db.tbl_class tc ON ( tqc.class_id = tc.id  )  
                            INNER JOIN amirkabir_db.tbl_user tu ON ( tc.id = tu.class_id  )  
                    INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq.fasl_id = tf.id  )  
                        INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )  
                WHERE tu.id = :id");
        $stmt->bindParam(':id', $adminid[0]['id']);
        $stmt->execute();
        $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = array_merge($result11, $data);
        $Access = false;
        // echo "      aaaaaaaaaaaaaaaaaaaaaaaaaaaa    ";

        foreach ($data as $key => $quiz) {
            if ($quiz['id'] == $quizId) {
                $Access = true;
                break;
            }
        }
    }

    // echo json_encode($Access);
    // print_r($data);
    return $Access;
}
function sidadminchek($sidget)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new PDO("mysql:host=$servername;dbname=amirkabir_db", $username, $password);
    // set the PDO Exception $error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $stmt = $conn->prepare("SELECT ta.id
    FROM amirkabir_db.tbl_sid ts 
        INNER JOIN amirkabir_db.tbl_admin ta ON ( ts.adminid = ta.id  )   where ts.sid = :sid");
    $stmt->bindParam(':sid', $sidget);

    $stmt->execute();

    // set the resulting array to associative

    $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result1;
}
function sidsudentchek($sidget)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new PDO("mysql:host=$servername;dbname=amirkabir_db", $username, $password);
    // set the PDO Exception $error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $stmt = $conn->prepare("SELECT ta.id
    FROM amirkabir_db.tbl_sid ts 
        INNER JOIN amirkabir_db.tbl_user ta ON ( ts.userid = ta.id  )   where ts.sid = :sid");
    $stmt->bindParam(':sid', $sidget);

    $stmt->execute();

    // set the resulting array to associative

    $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result1;
}
$rateLimit = 3; // تعداد مجاز درخواست‌ها در یک بازه زمانی
$expiryTime = 10; // زمان بازه زمانی به ثانیه

session_start();
if (!isset($_SESSION['requests'])) {
    $_SESSION['requests'] = 1;
    $_SESSION['last_request_time'] = time();
} else {
    $elapsedTime = time() - $_SESSION['last_request_time'];

    if ($elapsedTime < $expiryTime) {
        if ($_SESSION['requests'] < $rateLimit) {
            $_SESSION['requests']++;
        } else {
            http_response_code(429); // کد وضعیت Too Many Requests
            die("تعداد درخواست‌های شما بیش از حد مجاز است.");
        }
    } else {
        $_SESSION['requests'] = 1;
        $_SESSION['last_request_time'] = time();
    }
}
if ($api == "questionIdsByQuiz") {
    $adminId = sidadminchek($d['sid']);

    $stmt = $conn->prepare("SELECT tqq.question_id
FROM amirkabir_db.tbl_question_quiz tqq 
WHERE tqq.quiz_id = :quiz_id");
    $stmt->bindParam(':quiz_id', $d['quiz_id']);
    $stmt->execute();
    $question_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode(['success' => true, 'question_ids' => $question_list]));
}
if ($api == "questionListByFasl") {
    $adminId = sidadminchek($d['sid']);

    $stmt = $conn->prepare("SELECT tq.id, tq.`text`, tq.score, tq.level FROM amirkabir_db.tbl_question tq  	INNER JOIN amirkabir_db.tbl_question_quiz tqq ON ( tq.id = tqq.question_id  )   		INNER JOIN amirkabir_db.tbl_quiz tq1 ON ( tqq.quiz_id = tq1.id  )   			INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq1.fasl_id = tf.id  )   				INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )   WHERE tf.id = :fasl_id 	GROUP BY tq.id");
    $stmt->bindParam(':fasl_id', $d['fasl_id']);
    $stmt->execute();
    $question_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode(['success' => true, 'question_list' => $question_list]));
}
if ($api == "addExistQuestionToQuiz") {
    $adminId = sidadminchek($d['sid']);
    if ($d['add']) {
        $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_question_quiz
( quiz_id, question_id) VALUES ( :quiz_id, :question_id );");
        $stmt->bindParam(':quiz_id', $d['quiz_id']);
        $stmt->bindParam(':question_id', $d['question_id']);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("DELETE FROM amirkabir_db.tbl_question_quiz WHERE quiz_id=:quiz_id AND question_id=:question_id;");
        $stmt->bindParam(':quiz_id', $d['quiz_id']);
        $stmt->bindParam(':question_id', $d['question_id']);
        $stmt->execute();
    }
    print_r(json_encode(['success' => true]));
}
if($api == "listschool"){
    $sc = array();
    $stmt = $conn->prepare("SELECT id, name, school_code
FROM
	amirkabir_db.tbl_school l");
 
    $stmt->execute();
    $chek = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($chek as $school){
        $sc[] = $school;
    }
    print_r(json_encode([ $sc]));
}
if ($api == "listclassschool") {
    $sc = array();
    $stmt = $conn->prepare("SELECT id, name
FROM
	amirkabir_db.tbl_class s where school_id = :sc");
    $stmt->bindParam(':sc', $d['school']);
    $stmt->execute();
    $chek = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($chek as $school) {
        $sc[] = $school;
    }
    print_r(json_encode([$sc]));
}

if($api == "insertuser"){
    $stmt = $conn->prepare("SELECT id, fname, lname, username, password, email, phone, location, address, class_id
FROM
	amirkabir_db.tbl_user r where username = :uname and password = :pass");
    $stmt->bindParam(':uname', $d['uname']);
    $stmt->bindParam(':pass', $d['pass']);
    $stmt->execute();
    $chek= $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount() <= 0){
try{
            $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_user
	( id, fname, lname, username, password, email, phone, location, address, class_id) VALUES ( '', :fname, :lname, :uname, :pass, :email, :phone, :location, :address, :class_id );");
            $stmt->bindParam(':fname', $d['fname']);
            $stmt->bindParam(':lname', $d['lname']);
            $stmt->bindParam(':uname', $d['uname']);
            $stmt->bindParam(':pass', $d['pass']);
            $stmt->bindParam(':email', $d['email']);
            $stmt->bindParam(':phone', $d['phone']);
            $stmt->bindParam(':location', $d['location']);
            $stmt->bindParam(':address', $d['address']);
            $stmt->bindParam(':class_id', $d['class_id']);
            $stmt->execute();
            print_r(json_encode(['msg' => "add shod" , 'add' => true]));
}
catch(\Throwable $th){
            print_r(json_encode(['msg' => $th, 'add' => false]));
}
    }
    else{
        print_r(json_encode(['eror' => false]));
    }
}
if($api == "quizcheekansewer"){
    $id = sidsudentchek($d['sid']);
    $id = $id[0]['id'];
    $stmt = $conn->prepare("SELECT id, user_id, quiz_id, quiestion_id, answer_id
    FROM
        amirkabir_db.tbl_useranswer r where user_id = :id and quiz_id = :qid");
   $stmt->bindParam(':id',$id);
   $stmt->bindParam(':qid', $d['id']);
   $stmt->execute();
   $chek = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    print_r(json_encode([$stmt->rowCount()]) );
   if($stmt->rowCount() > 0){
    print_r(json_encode(true));
   }
   else{
    print_r(json_encode(false));
   }

}
if ($api == "quizWizard") {
    $adminId = sidadminchek($d['sid']);
    if ($d['classified']) {
    } else {
        $stmt = $conn->prepare("SELECT tq.id, tq.`text`, tq.score, tq.level FROM amirkabir_db.tbl_question tq  	INNER JOIN amirkabir_db.tbl_question_quiz tqq ON ( tq.id = tqq.question_id  )   		INNER JOIN amirkabir_db.tbl_quiz tq1 ON ( tqq.quiz_id = tq1.id  )   			INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq1.fasl_id = tf.id  )   				INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )  
         WHERE tf.id = :fasl_id AND tq.level = :difficulty GROUP BY tq.id");
        $stmt->bindParam(':fasl_id', $d['fasl_id']);
        $stmt->bindParam(':difficulty', $d['difficulty']);
        $stmt->execute();
        $question_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $question_ids = array();
        $question_results = array();
        while (count($question_ids) < $d['question_count']) {
            $thisRandom = rand(0, count($question_list) - 1);
            if (!in_array($thisRandom, $question_ids)) {
                array_push($question_ids, $thisRandom);
            }
        }
        foreach ($question_ids as $key => $value) {
            array_push($question_results, $question_list[$value]);
        }
        foreach ($question_results as $key => $question) {
            // $question['id']
            $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_question_quiz
	( quiz_id, question_id) VALUES ( :quiz_id, :question_id );");
            $stmt->bindParam(':quiz_id', $d['quiz_id']);
            $stmt->bindParam(':question_id', $question['id']);
            $stmt->execute();
        }
    }

    print_r(json_encode(['success' => true, 'question_ids' => $question_ids, '$question_results' => $question_results]));
}
if ($api == "studentList") {
    $adminId = sidadminchek($d['sid']);

    if (!isset($d['classId'])) {
        $stmt = $conn->prepare("SELECT tu.id, tu.fname, tu.lname, tu.username
FROM amirkabir_db.tbl_user tu 
	INNER JOIN amirkabir_db.tbl_class tc ON ( tu.class_id = tc.id  )  
		INNER JOIN amirkabir_db.tbl_admin_class tac ON ( tc.id = tac.class_id  )  
			INNER JOIN amirkabir_db.tbl_admin ta ON ( tac.admin_id = ta.id  )  
WHERE ta.id = :user_id");
        $stmt->bindParam(':user_id', $adminId[0]['id']);
        $stmt->execute();
        $userList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $conn->prepare("SELECT tu.id, tu.fname, tu.lname, tc.name
    FROM amirkabir_db.tbl_user tu 
        INNER JOIN amirkabir_db.tbl_class tc ON ( tu.class_id = tc.id  )  
            INNER JOIN amirkabir_db.tbl_admin_class tac ON ( tc.id = tac.class_id  )  
                INNER JOIN amirkabir_db.tbl_admin ta ON ( tac.admin_id = ta.id  )  
    WHERE tc.id = :class_id AND
        ta.id = :user_id");
        $stmt->bindParam(':user_id', $adminId[0]['id']);
        $stmt->bindParam(':class_id', $d['classId']);
        $stmt->execute();
        $userList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    print_r(json_encode(['success' => true, 'userList' => $userList]));
}



if ($api == "showQuestionInQuiz") {
    $adminId = sidadminchek($d['sid']);
    $stmt = $conn->prepare("SELECT tq.id, tq.`text`, tq.score, tq.level
FROM amirkabir_db.tbl_question tq 
	INNER JOIN amirkabir_db.tbl_question_quiz tqq ON ( tq.id = tqq.question_id  )  
WHERE tqq.quiz_id = :quiz_id");
    $stmt->bindParam(':quiz_id', $d['quiz_id']);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    print_r(json_encode(['success' => true, 'data' => $data]));
}

if ($api == "SiteDetail") {
    $adminId = sidadminchek($d['sid']);
    $stmt = $conn->prepare("SELECT count(*) count
FROM amirkabir_db.tbl_quiz tq");
    $stmt->execute();
    $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $count[0]['count'];
    $stmt = $conn->prepare("SELECT COUNT(DISTINCT quiz_id) AS total_completed_tests
FROM amirkabir_db.tbl_useranswer
GROUP BY user_id;");
    $stmt->execute();
    $completedQuizes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $quizCompletedCount = 0;
    foreach ($completedQuizes as $key => $completedQuizes) {
        $quizCompletedCount += $completedQuizes['total_completed_tests'];
    }

    print_r(json_encode(['success' => true, 'AllQuizCounts' => $count, 'CompletedQuizCounts' => $quizCompletedCount]));
}

if ($api == "addUsersToTest") {
    $success = false;
    $adminId = sidadminchek($d['sid']);
    if ($d['dataType'] == 'class') {
        $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_quiz_class
	( quiz_id, class_id) VALUES ( :quiz_id, :class_id );");
        $stmt->bindParam(':quiz_id', $d['quiz_id']);
        $stmt->bindParam(':class_id', $d['class']);
        $stmt->execute();
        $success = true;
    } else if ($d['dataType'] == 'student') {
        $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_quiz_user
	( quiz_id, user_id) VALUES ( :quiz_id, :user_id );");
        $stmt->bindParam(':quiz_id', $d['quiz_id']);
        $stmt->bindParam(':user_id', $d['student']);
        $stmt->execute();
        $success = true;
    }
    print_r(json_encode(['success' => $success]));
}

if ($api == "getUsersToTest") {
    $success = false;
    $adminId = sidadminchek($d['sid']);
    $stmt = $conn->prepare("SELECT CONCAT(tu.fname ,' ', tu.lname) as 'name' FROM amirkabir_db.tbl_quiz_user tqu  	INNER JOIN amirkabir_db.tbl_user tu ON ( tqu.user_id = tu.id  )   
    WHERE tqu.quiz_id = :quiz_id");
    $stmt->bindParam(':quiz_id', $d['quiz_id']);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $conn->prepare("SELECT tc.name FROM amirkabir_db.tbl_quiz_class tqc INNER JOIN amirkabir_db.tbl_class tc ON ( tqc.class_id = tc.id  )
    WHERE tqc.quiz_id = :quiz_id");
    $stmt->bindParam(':quiz_id', $d['quiz_id']);
    $stmt->execute();
    $class = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode(['success' => $success, 'class' => $class, 'users' => $users]));
}



if($api == "emtyaz"){
    $stmt = $conn->prepare("SELECT emtyaz FROM tbl_sid where sid = :sid");
    $stmt->bindParam(':sid',$d['sid']);

    $stmt->execute();
    $participate = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    print_r(json_encode($participate));
    
}

if($api == "nextmarhale"){
    $stmt = $conn->prepare("UPDATE amirkabir_db.tbl_sid SET emtyaz = emtyaz - :score  where sid = :sid ");
    $stmt->bindParam(':sid', $d['sid']);
    $stmt->bindParam(':score', $d['score']);
    $stmt->execute();
    $stmt = $conn->prepare("UPDATE amirkabir_db.tbl_sid SET marhale = marhale +1  where sid = :sid ");
    $stmt->bindParam(':sid', $d['sid']);

    $stmt->execute();
    
}
if($api == "marhale"){
    $stmt = $conn->prepare("SELECT marhale FROM tbl_sid where sid = :sid");
    $stmt->bindParam(':sid',$d['sid']);

    $stmt->execute();
    $participate = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    print_r(json_encode($participate));
    
}
if ($api == "resultonce") {
    $userId = sidsudentchek($d['sid']);
    $stmt = $conn->prepare("SELECT tu.id, tu.user_id, tu.quiz_id, tu.quiestion_id, tu.answer_id
FROM amirkabir_db.tbl_useranswer tu 
WHERE tu.user_id = :user_id and  tu.quiz_id = :qid
	GROUP BY  tu.quiz_id");
    $stmt->bindParam(':user_id', $userId[0]['id']);
    $stmt->bindParam(':qid', $d['qid']);
    $stmt->execute();
    $participate = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $quizIds = array();
    foreach ($participate as $key => $quiz) {
        array_push($quizIds, $quiz['quiz_id']);
    }
    $resluts = [];
    foreach ($quizIds as $key => $quiz) {
        $sumScore = 0;
        $userScore = 0;
        $stmt = $conn->prepare("SELECT tqq.quiz_id, tqq.question_id, tq.score, ta.id
FROM amirkabir_db.tbl_question_quiz tqq 
	INNER JOIN amirkabir_db.tbl_question tq ON ( tqq.question_id = tq.id  )  
		INNER JOIN amirkabir_db.tbl_answer ta ON ( tq.id = ta.question_id  )  
WHERE tqq.quiz_id = :quiz_id AND
	ta.iscorect = true");
        $stmt->bindParam(':quiz_id', $quiz);
        $stmt->execute();
        $questionPerQuiz = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "\n";
        foreach ($questionPerQuiz as $key => $question) {
            $sumScore += $question['score'];
            $stmt = $conn->prepare("SELECT tu.id, tu.user_id, tu.quiz_id, tu.quiestion_id, tu.answer_id FROM amirkabir_db.tbl_useranswer tu 
            WHERE tu.user_id = :user_id AND tu.quiz_id = :quiz_id AND tu.quiestion_id = :quiestion_id AND
	tu.answer_id = :answer_id ; ");
            $stmt->bindParam(':quiz_id', $quiz);
            $stmt->bindParam(':user_id', $userId[0]['id']);
            $stmt->bindParam(':quiestion_id', $question['question_id']);
            $stmt->bindParam(':answer_id', $question['id']);
            $stmt->execute();
            $useranswer = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($useranswer) {
                $userScore += $question['score'];
            }
        }
        $stmt = $conn->prepare("SELECT tq.name, tq.level, ta.fname, ta.lname, tf.fasl, td.name
FROM amirkabir_db.tbl_quiz tq 
	INNER JOIN amirkabir_db.tbl_admin ta ON ( tq.admin_id = ta.id  )  
	INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq.fasl_id = tf.id  )  
		INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )  
WHERE tq.id = :quiz_id");
        $stmt->bindParam(':quiz_id', $quiz);
        $stmt->execute();
        $quizDetail = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $quizDetail = $quizDetail[0];
        // print_r(json_encode($quizDetail));
        // print_r($quizDetail);
        $thisQuiz = ['score' => $userScore, 'sumScore' => $sumScore, 'name' => $quizDetail['name'], 'adminName' => $quizDetail['fname'] . " " . $quizDetail['lname']];
        array_push($resluts, $thisQuiz);
        // echo $sumScore;
    }
    print_r(json_encode(['data' => $resluts, 'success' => true]));
}
if ($api == "result") {
    $userId = sidsudentchek($d['sid']);
    $stmt = $conn->prepare("SELECT tu.id, tu.user_id, tu.quiz_id, tu.quiestion_id, tu.answer_id
FROM amirkabir_db.tbl_useranswer tu 
WHERE tu.user_id = :user_id
	GROUP BY  tu.quiz_id");
    $stmt->bindParam(':user_id', $userId[0]['id']);
    $stmt->execute();
    $participate = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $quizIds = array();
    foreach ($participate as $key => $quiz) {
        array_push($quizIds, $quiz['quiz_id']);
    }
    $resluts = [];
    foreach ($quizIds as $key => $quiz) {
        $sumScore = 0;
        $userScore = 0;
        $stmt = $conn->prepare("SELECT tqq.quiz_id, tqq.question_id, tq.score, ta.id
FROM amirkabir_db.tbl_question_quiz tqq 
	INNER JOIN amirkabir_db.tbl_question tq ON ( tqq.question_id = tq.id  )  
		INNER JOIN amirkabir_db.tbl_answer ta ON ( tq.id = ta.question_id  )  
WHERE tqq.quiz_id = :quiz_id AND
	ta.iscorect = true");
        $stmt->bindParam(':quiz_id', $quiz);
        $stmt->execute();
        $questionPerQuiz = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "\n";
        foreach ($questionPerQuiz as $key => $question) {
            $sumScore += $question['score'];
            $stmt = $conn->prepare("SELECT tu.id, tu.user_id, tu.quiz_id, tu.quiestion_id, tu.answer_id FROM amirkabir_db.tbl_useranswer tu 
            WHERE tu.user_id = :user_id AND tu.quiz_id = :quiz_id AND tu.quiestion_id = :quiestion_id AND
	tu.answer_id = :answer_id ; ");
            $stmt->bindParam(':quiz_id', $quiz);
            $stmt->bindParam(':user_id', $userId[0]['id']);
            $stmt->bindParam(':quiestion_id', $question['question_id']);
            $stmt->bindParam(':answer_id', $question['id']);
            $stmt->execute();
            $useranswer = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($useranswer) {
                $userScore += $question['score'];
            }
        }
        $stmt = $conn->prepare("SELECT tq.name, tq.level, ta.fname, ta.lname, tf.fasl, td.name
FROM amirkabir_db.tbl_quiz tq 
	INNER JOIN amirkabir_db.tbl_admin ta ON ( tq.admin_id = ta.id  )  
	INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq.fasl_id = tf.id  )  
		INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )  
WHERE tq.id = :quiz_id");
        $stmt->bindParam(':quiz_id', $quiz);
        $stmt->execute();
        $quizDetail = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $quizDetail = $quizDetail[0];
        // print_r(json_encode($quizDetail));
        // print_r($quizDetail);
        $thisQuiz = ['score' => $userScore, 'sumScore' => $sumScore, 'name' => $quizDetail['name'], 'adminName' => $quizDetail['fname'] . " " . $quizDetail['lname']];
        array_push($resluts, $thisQuiz);
        // echo $sumScore;
    }
    print_r(json_encode(['data' => $resluts, 'success' => true]));
}
if ($api == "submitQuiz") {
    $userId = sidsudentchek($d['sid']);
    $quiz_id = $d['quiz_id'];
    $stmt = $conn->prepare("SELECT tu.id, tu.user_id, tu.quiz_id, tu.quiestion_id, tu.answer_id
    FROM amirkabir_db.tbl_useranswer tu 
    WHERE tu.user_id = :userId AND
        tu.quiz_id = :quizId");
    $stmt->bindParam(':userId', $userId[0]['id']);
    $stmt->bindParam(':quizId', $quiz_id);
    $stmt->execute();
    $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $access = checkQuizAccess($quiz_id, $d['sid']);
    if ($access && !$result11) {
        foreach ($d["answers"] as $key => $answer) {

            $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_useranswer
            ( id, user_id, quiz_id, quiestion_id, answer_id) VALUES ( NUll, :userId, :quizId, :questionId, :answerID );");
            $stmt->bindParam(':userId', $userId[0]['id']);
            $stmt->bindParam(':quizId', $quiz_id);
            $stmt->bindParam(':questionId', $key);
            $stmt->bindParam(':answerID', $answer);
            $stmt->execute();
            // $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        print_r(json_encode(['success' => true ,'insert' => true]));
    }

    /////////////////////////////////

    require 'vendor/autoload.php';


    $url = 'http://localhost/api/api.php';

    // داده‌هایی که می‌خواهید به API ارسال کنید (به صورت JSON)
    $data = [
        'type' => 'resultonce',
        'sid' => $d['sid'],
        'qid' => $quiz_id,
    ];
    
    // تنظیمات برای ارسال درخواست
    $options = [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode($data),
    ];
    
    try {
        // ارسال درخواست POST به API و دریافت پاسخ
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', $url, $options);
    
        // خواندن محتوای پاسخ
        $body = $response->getBody()->getContents();
    
        // تبدیل رشته JSON به آرایه
        $responseData = json_decode($body, true);
    
        // بررسی موفقیت درخواست
        if ($responseData['success']) {
            // محاسبه جمع sumScore
            $sumScore = 0;
            foreach ($responseData['data'] as $item) {
                $sumScore += $item['score'];
            }
    
            // چاپ جمع sumScore
             $data = json_encode(["nomre"=>$sumScore]);
             $stmt = $conn->prepare("UPDATE amirkabir_db.tbl_sid SET emtyaz = emtyaz + :score  where sid = :sid ");
             $stmt->bindParam(':sid', $d['sid']);
             $stmt->bindParam(':score', $sumScore);
             $stmt->execute();
        
        } else {
            echo "خطا: درخواست موفق نبود.";
        }
    } catch (Exception $e) {
        // در صورت بروز خطا
        $data = json_encode(["خطا: " . $e->getMessage()]);
   
    }
    

}
if ($api == "quizData") {
    $quiz_id = $d['quiz_id'];
    $access = checkQuizAccess($quiz_id, $d['sid']);
    if ($access) {
        $stmt = $conn->prepare("SELECT tq.id, tq.`text`, tq.score, tq.level
                                FROM amirkabir_db.tbl_question tq 
	                            INNER JOIN amirkabir_db.tbl_question_quiz tqq ON ( tq.id = tqq.question_id  )  
                                WHERE tqq.quiz_id = :quiz_id");
        $stmt->bindParam(':quiz_id', $quiz_id);
        $stmt->execute();
        $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result11 as $key => $question) {
            $stmt = $conn->prepare("
                                    SELECT ta.id, ta.question_id, ta.`text`, ta.switch
                                    FROM amirkabir_db.tbl_answer ta 
                                    WHERE ta.question_id = :question_id
                                    ");
            $stmt->bindParam(':question_id', $question['id']);
            $stmt->execute();
            $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result11[$key]['Answers'] = $answers;
        }

        print_r(json_encode(['data' => $result11, 'success' => true]));
    }
}
if ($api == "deletequiz") {
    $adminid = sidadminchek($d['sid']);
    if ($adminid) {
        try {

            $stmt = $conn->prepare("DELETE FROM amirkabir_db.tbl_quiz  where tbl_quiz.id = :id");
            $stmt->bindParam(':id', $d['quizID']);
            $stmt->execute();
            $data = json_encode([
                "msg" => "Ok",
                "success" => true
            ]);
        } catch (\Throwable $th) {
            $data = json_encode([
                "msg" => "no",
                "success" => false
            ]);
        }
    }
    print_r($data);
}
if ($api == "listquiz") {
    // TODO what is adbir?
    if ($d['ac'] == "adbir") {
        $adminid = sidadminchek($d['sid']);
        if ($adminid) {
            $stmt = $conn->prepare("SELECT tq.id, tq.name title, tq.level, tf.fasl, td.name bookName
FROM amirkabir_db.tbl_admin ta 
	INNER JOIN amirkabir_db.tbl_quiz tq ON ( ta.id = tq.admin_id  )  
		INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq.fasl_id = tf.id  )  
			INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )  
WHERE ta.id = 2");
            $test = 2;
            // $stmt->bindParam(':id', $test);
            $stmt->execute();
            $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result11) {
                $data = json_encode([$result11]);
            } else {
                $data = json_encode([null]);
            }
        } else {
            $data = json_encode(["mess" => "1نا معتبر"]);
        }
    }
    if ($d['ac'] == "student") {
        $adminid = sidsudentchek($d['sid']);
        if ($adminid) {

            if ($d['on'] == "self") {
                $stmt = $conn->prepare("SELECT tq.id, tq.name title, tq.level, tf.fasl, td.name bookName
                FROM amirkabir_db.tbl_quiz tq 
                    INNER JOIN amirkabir_db.tbl_quiz_user tqu ON ( tq.id = tqu.quiz_id  )  
                        INNER JOIN amirkabir_db.tbl_user tu ON ( tqu.user_id = tu.id  )  
                    INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq.fasl_id = tf.id  )  
                        INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )  
                WHERE tu.id = :id");
                // $stmt = $conn->prepare("SELECT tu.id, tu.fname, tu.lname, tq.name, tq.level, tf.fasl, td.name FROM amirkabir_db.tbl_user tu 	INNER JOIN amirkabir_db.tbl_quiz_user tqu ON ( tu.id = tqu.user_id  )  		INNER JOIN amirkabir_db.tbl_quiz tq ON ( tqu.quiz_id = tq.id  )  			INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq.fasl_id = tf.id  )  				INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )      where tqu.user_id = :id");

                $stmt->bindParam(':id', $adminid[0]['id']);
                $stmt->execute();
                $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($result11) {
                    $data = json_encode([$result11][0]);
                } else {
                    $data = json_encode([null]);
                }
            } elseif ($d['on'] == "class") {
                $stmt = $conn->prepare("SELECT tq.id, tq.name title, tq.level, tf.fasl, td.name bookName
                FROM amirkabir_db.tbl_quiz tq 
                    INNER JOIN amirkabir_db.tbl_quiz_class tqc ON ( tq.id = tqc.quiz_id  )  
                        INNER JOIN amirkabir_db.tbl_class tc ON ( tqc.class_id = tc.id  )  
                            INNER JOIN amirkabir_db.tbl_user tu ON ( tc.id = tu.class_id  )  
                    INNER JOIN amirkabir_db.tbl_fasl tf ON ( tq.fasl_id = tf.id  )  
                        INNER JOIN amirkabir_db.tbl_dars td ON ( tf.dars_id = td.id  )  
                WHERE tu.id = :id");
                $stmt->bindParam(':id', $adminid[0]['id']);
                $stmt->execute();
                $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($result11) {
                    $data = json_encode([$result11][0]);
                } else {
                    $data = json_encode([null]);
                }
            } else {
            }
        } else {
            $data = json_encode(["mess" => "2ر"]);
        }
    }
    //  else {
    //     $data = json_encode(["mess" => "3نا معتبر"]);
    // }
    print_r($data);
}
if ($api == "addAnswer") {
    if ($d['sid']) {
        $adminid = sidadminchek($d['sid']);
        if ($adminid) {
            $question_id = $d['question_id'];
            $answers = $d['answers'];
            $stmt = $conn->prepare("SELECT ta.id, ta.question_id, ta.iscorect, ta.`text`, ta.switch
FROM amirkabir_db.tbl_answer ta 
WHERE ta.question_id = :question_id
	ORDER BY ta.id DESC limit 1");
            $stmt->bindParam(':question_id', $question_id);
            $stmt->execute();
            $lastSwitchInThisQuestion = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($lastSwitchInThisQuestion);
            if (!$lastSwitchInThisQuestion) {
                $lastSwitchInThisQuestion = 0;
            } else {
                $lastSwitchInThisQuestion = $lastSwitchInThisQuestion[0]['switch'];
            }
            $lastIdQuestion = $conn->lastInsertId();
            foreach ($answers as $key => $answer) {
                // echo "laaaaaaaaaaaaaaaaaaaast:", $lastSwitchInThisQuestion;
                // var_dump($answer["text"]);
                // var_dump($question_id);
                $lastSwitchInThisQuestion++;
                $stmt = '';
                $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_answer
	( id, question_id, iscorect, `text`, switch) VALUES ( null, :question_id, :iscorect, :text,:switch );");
                // $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
                // echo $answer['iscorect'];
                $stmt->bindParam(':iscorect', $answer['iscorect'], PDO::PARAM_INT);
                $stmt->bindParam(':text', $answer['text']);
                $stmt->bindParam(':switch', $lastSwitchInThisQuestion);
                $stmt->bindParam(':question_id', $question_id);
                $stmt->execute();
            }
            $data = json_encode(["mess" => 'all ok', "success" => true]);
            print_r($data);
        }
    }
}
if ($api == "addQuestion") {
    if ($d['sid']) {
        $adminid = sidadminchek($d['sid']);
        if ($adminid) {
            // $stmt1 = $conn->prepare("SELECT LAST_INSERT_ID() lastIndex;");
            $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_question
            ( id, `text`, score, level) VALUES ( null, :text, :score, :level );");
            $stmt->bindParam(':text', $d['text']);
            $stmt->bindParam(':score', $d['score']);
            $stmt->bindParam(':level', $d['level']);
            $stmt->execute();
            $lastIdQuestion = $conn->lastInsertId();
            $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_question_quiz
            ( quiz_id, question_id) VALUES ( :quiz_id , :question_id );");
            $stmt->bindParam(':quiz_id', $d['quiz_id']);
            $stmt->bindParam(':question_id', $lastIdQuestion);
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO amirkabir_db.tbl_admin_question
            ( admin_id, question_id) VALUES ( :adminId, :question_id );");
            $stmt->bindParam(':adminId', $adminid[0]['id']);
            $stmt->bindParam(':question_id', $lastIdQuestion);
            // $stmt->bindParam(':quiz_id', $d['quiz_id']);
            $stmt->execute();
            $data = json_encode(["mess" => 'all ok', "lastIdQuestion" => $lastIdQuestion, "success" => true]);
            print_r($data);
        }
    }
}
if ($api == "makequiz") {
    if ($d['sid']) {
        $adminid = sidadminchek($d['sid']);
        if ($adminid) {

            $stmt = $conn->prepare("SELECT  dars_id
FROM
	amirkabir_db.tbl_fasl l where id = :fasl");
            $stmt->bindParam(':fasl', $d['fasl']);
            $stmt->execute();
            $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result11) {
                $darsid =  $result11[0]["dars_id"];
                $stmt = $conn->prepare("SELECT  grade_id
FROM
	amirkabir_db.tbl_dars s where id = :id");
                $stmt->bindParam(':id', $darsid);
                $stmt->execute();
                $gradeidrs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($gradeidrs) {
                    $gradeid = $gradeidrs[0]['grade_id'];
                }
            }
            try {
                $stmt1 = $conn->prepare("INSERT INTO `tbl_quiz` (`id`, `name`, `fasl_id`, `admin_id`, `level`) VALUES (NULL, :nameaaa, :darsid, :adminid, :level);SELECT LAST_INSERT_ID();");
                $stmt1->bindParam(':adminid', $adminid[0]['id']);
                $stmt1->bindValue(':nameaaa', $d['name'], PDO::PARAM_STR);
                $stmt1->bindParam(':darsid', $d['fasl']);
                $stmt1->bindParam(':level', $d['level']);
                $stmt1->execute();
                $stmt1 = $conn->prepare("SELECT LAST_INSERT_ID() lastIndex;");
                $stmt1->execute();
                // $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // print_r($stmt1->fetchAll(PDO::FETCH_ASSOC));
                $data = json_encode(["mess" => $stmt1->fetchAll(PDO::FETCH_ASSOC)[0], "success" => true]);
            } catch (\Throwable $th) {
                $data = json_encode(["mess" => $th, "success" => false]);
            }

            print_r($data);
        }
    }
}
if ($api == "dars") {
    $stmt = $conn->prepare("SELECT id, name, grade_id
    FROM
        amirkabir_db.tbl_dars s;");


    $stmt->execute();

    // set the resulting array to associative

    $ddd = array();
    $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result11) {
        foreach ($result11 as $item) {
            $ddd[] = $item;
        }
        $data = json_encode(["mess" => $ddd]);
    } else {
        $data = json_encode([null]);
    }

    print_r($data);
}
if ($api == "fasl") {
    $stmt = $conn->prepare("SELECT id, fasl name
    FROM
        amirkabir_db.tbl_fasl where dars_id = :id");
    $stmt->bindParam(':id', $d['darsId']);

    $stmt->execute();

    // set the resulting array to associative

    $ddd = array();
    $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result11) {
        foreach ($result11 as $item) {
            $ddd[] = $item;
        }
        $data = json_encode(["mess" => $ddd]);
    } else {
        $data = json_encode([null]);
    }

    print_r($data);
}
if ($api == "checktoken") {


    $stmt = $conn->prepare("SELECT  r.fname as 'user',n.fname as 'admin',d.userid,d.adminid
       FROM
       tbl_sid d ,tbl_admin n,tbl_user r
       where   (n.id = d.adminid or r.id = d.userid) and d.sid=:sid limit 1");
    $stmt->bindParam(':sid', $d['sid']);

    $stmt->execute();

    // set the resulting array to associative

    $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result11[0]['adminid']) {
        $data = json_encode(["mess" => ["name" => $result11[0]['admin'], "ac" => "admin"]]);
    } elseif ($result11[0]['userid']) {
        $data = json_encode(["mess" => ["name" => $result11[0]['user'], "ac" => "user"]]);
    } else {
        $data = json_encode([null]);
    }

    print_r($data);
}

if ($api == "lastquestions") {
    $result1 =   sidadminchek($d['sid']);
    if ($result1) {
        $stmt = $conn->prepare("SELECT id, `text`, score, level
    FROM
        amirkabir_db.tbl_question n limit :limit");
        $stmt->bindValue(':limit', $d['count'], PDO::PARAM_INT);
        $aa = array();
        $stmt->execute();

        // set the resulting array to associative

        $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result11) {
            foreach ($result11 as $item) {
                $aa[] = $item;
            }
            $data = json_encode($aa);
        } else {
            $data = json_encode([null]);
        }
    } else {
        $data = json_encode(["r" => "not login"]);
    }
    print_r($data);
}
if ($api == "quiz") {
    // TODO : add user access check
    $stmt = $conn->prepare("SELECT question_id
    FROM amirkabir_db.tbl_question_quiz z where quiz_id = :id");
    $stmt->bindParam(':id', $d['quizid']);

    $stmt->execute();

    // set the resulting array to associative

    $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result1) {

        foreach ($result1 as $item) {
            $stmt = $conn->prepare("SELECT id, text , score   FROM  amirkabir_db.tbl_question n where  n.id = :id");
            $stmt->bindParam(':id', $item["question_id"]);
            $stmt->execute();

            // set the resulting array to associative

            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($questions as $question) {
                // $data1[$question["id"]] = {"text"=>$question["text"],"score"=>$question["score"]};
                // print_r($data1[$question["id"]] = {"text"=>$question["text"],"score"=>$question["score"]});
                $dataForSend[$question["id"]] = $question;
                $stmt = $conn->prepare("SELECT ta.id, ta.question_id, ta.iscorect, ta.`text`, ta.switch, tq.`text`, tq.score, tq.level
            FROM amirkabir_db.tbl_answer ta 
                INNER JOIN amirkabir_db.tbl_question tq ON ( ta.question_id = tq.id  )  
            WHERE tq.id = :id");
                $stmt->bindParam(':id', $item["question_id"]);
                $stmt->execute();

                $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $dataForSend[$question["id"]]["answers"] = $answers;
                // print_r($dataForSend["aaaaaa"]);
            }

            //     $stmt = $conn->prepare("SELECT  question_id, `text`, switch
            //     FROM
            //         amirkabir_db.tbl_answer r; where  r.question_id = :id");
            //     $stmt->bindParam(':id', $item["question_id"]);
            //    $stmt->execute();

            //    // set the resulting array to associative

            //    $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //    $questions[$item["question_id"]]["answaer"] = $result2;
            $data = json_encode(["messs" => $dataForSend]);
        }
    } else {
        $data = json_encode(["message" => null]);
    }
    if (isset($data)) {
        print_r($data);
    }
}

if ($api == "akharinsoalat") {

    $stmt = $conn->prepare("  SELECT adminid  FROM amirkabir_db.tbl_sid  where sid = :sid ");
    $stmt->bindParam(':sid', $d['sid']);

    $stmt->execute();

    // set the resulting array to associative

    $result11 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result11) {
        // $data = json_encode(["اطلاعات کاربری" => $result11[0]["adminid"]]);
        // print_r($data);
        $stmt = $conn->prepare("SELECT taq.admin_id, tq.`text`, tq.score, tq.level
        FROM amirkabir_db.tbl_admin_question taq 
            INNER JOIN amirkabir_db.tbl_question tq ON ( taq.question_id = tq.id  )  where taq.admin_id = :id order by tq.id DESC limit 3");
        $stmt->bindParam(':id', $result11[0]["adminid"]);

        $stmt->execute();

        // set the resulting array to associative

        $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result1) {
            $data = json_encode([" اخرین سوالات" => $result1]);
            print_r($data);
        } else {
            $data = json_encode([" اخرین سوالات" => ""]);
            print_r($data);
        }
    }
}
if ($api == "loginornot") {
    $stmt = $conn->prepare("SELECT userid FROM tbl_sid where sid = :sid");
    $stmt->bindParam(':sid', $d['sid']);

    $stmt->execute();

    // set the resulting array to associative

    $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result1) {
        $stmt = $conn->prepare("SELECT id, fname, lname, username, password, email, phone, location, address, class_id FROM tbl_user where id = :id");
        $stmt->bindParam(':id',  $result1[0]["userid"]);

        $stmt->execute();

        // set the resulting array to associative

        $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result2) {
            $data = json_encode(["اطلاعات کاربری" => $result2]);
        } else {
            $stmt = $conn->prepare("SELECT adminid FROM tbl_sid where sid = :sid");
            $stmt->bindParam(':sid', $d['sid']);

            $stmt->execute();

            // set the resulting array to associative

            $admintrue = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($admintrue) {
                $stmt = $conn->prepare("SELECT id, fname, lname, username, password, email, phone, location, ismodir, school_id, personnel_code FROM amirkabir_db.tbl_admin where id = :id");
                $stmt->bindParam(':id', $admintrue[0]["adminid"]);

                $stmt->execute();

                // set the resulting array to associative

                $admintrue1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($admintrue1) {
                    $data = json_encode(["اطلاعات کاربری" => $admintrue1]);
                }
            }
        }
    } else {
        $data = json_encode(["message" => "false", "eror" => "not found user"]);
    }

    print_r($data);
}
if ($api == "checkusers") {



    echo access();
}

if ($api == "classList") {
    if ($d['sid'][0] == null) {
        $d['sid'] = "eror";
        $data = json_encode([null, "msg" => "eror"]);
    } else {
        $iddabir = sidadminchek($d['sid']);


        if ($iddabir) {

            // TODO : change select type from dabirname to sid
            $stmt = $conn->prepare("SELECT tbl_class.id,  tbl_class.name as 'class name' ,tbl_school.name as 'school name ' 
    FROM tbl_admin,tbl_admin_class,tbl_class,tbl_school
    WHERE tbl_admin_class.admin_id= tbl_admin.id and tbl_school.id=tbl_class.school_id and  tbl_admin_class.class_id = tbl_class.id and tbl_admin.id=:id");
            $stmt->bindParam(':id', $iddabir[0]['id']);

            $stmt->execute();

            // set the resulting array to associative

            $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $aa = $stmt->rowCount();
            $class = array();

            //    for($i=0;$i<$aa;$i++){
            //     $class[$i]=$result1['نام کلاس'];
            //     }

            if ($result1) {
                foreach ($result1 as $row) {
                    $class[] = $row;
                }
                $data = json_encode(["classlist" => $class]);
            } else {
                $data = json_encode(["message" => "not class set"]);
            }
        } else {

            $data = json_encode(["eror" => "512alts#i#d"]);
        }
    }
    print_r($data);
}

if ($api == "quizlist") {

    //sid for moalem + dars name  + sakhti ya asoni   where 
    // zaman + name dars + sakhti  soaodi nozaoli 

    $result1 =  sidadminchek($d['sid']);


    if ($result1) {

        // if(isset( $d['sort']['type'])){
        //     $noe = $d['sort']['type'];
        //     if($noe == "zaman"){
        //         $stmt = $conn->prepare("SELECT tbl_dars.name as 'dars name',tbl_quiz.name as 'quiz name',tbl_quiz.level , tbl_quiz.id FROM tbl_dars,tbl_quiz,tbl_admin
        //         WHERE tbl_dars.id= tbl_quiz.dars_id and tbl_quiz.admin_id = tbl_admin.id and tbl_admin.ismodir = 0 and ( tbl_quiz.level = :level or  tbl_dars.name = :dars) and tbl_admin.id = :iddabir order by tbl_quiz.id DESC");
        //          $stmt->bindParam(':level', $d['level']);
        //          $stmt->bindParam(':dars', $d['darsname']);
        //          $stmt->bindParam(':iddabir',$result1[0]['id']);
        //         $stmt->execute();

        //         // set the resulting array to associative

        //         $rssort = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //         if($rssort){
        //             $datat = $rssort;
        //         }
        //     }
        //     if($noe == "namedars"){
        //         $stmt = $conn->prepare("SELECT tbl_dars.name as 'dars name',tbl_quiz.name as 'quiz name',tbl_quiz.level , tbl_quiz.id FROM tbl_dars,tbl_quiz,tbl_admin
        //         WHERE tbl_dars.id= tbl_quiz.dars_id and tbl_quiz.admin_id = tbl_admin.id and tbl_admin.ismodir = 0 and ( tbl_quiz.level = :level or  tbl_dars.name = :dars) and tbl_admin.id = :iddabir order by tbl_dars.name DESC");
        //          $stmt->bindParam(':level', $d['level']);
        //          $stmt->bindParam(':dars', $d['darsname']);
        //          $stmt->bindParam(':iddabir',$result1[0]['id']);
        //         $stmt->execute();

        //         // set the resulting array to associative

        //         $rssort = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //         if($rssort){
        //             $datat = $rssort;
        //         }
        //     }
        //     if($noe == "level"){
        //         $stmt = $conn->prepare("SELECT tbl_dars.name as 'dars name',tbl_quiz.name as 'quiz name',tbl_quiz.level , tbl_quiz.id FROM tbl_dars,tbl_quiz,tbl_admin
        //         WHERE tbl_dars.id= tbl_quiz.dars_id and tbl_quiz.admin_id = tbl_admin.id and tbl_admin.ismodir = 0 and ( tbl_quiz.level = :level or  tbl_dars.name = :dars) and tbl_admin.id = :iddabir order by tbl_quiz.level DESC");
        //          $stmt->bindParam(':level', $d['level']);
        //          $stmt->bindParam(':dars', $d['darsname']);
        //          $stmt->bindParam(':iddabir',$result1[0]['id']);
        //         $stmt->execute();

        //         // set the resulting array to associative

        //         $rssort = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //         if($rssort){
        //             $datat = $rssort;
        //         }
        //     }
        //     $data = json_encode($datat);
        // }

        // if(isset($d['filter']['darsname'])){
        //     $stmt = $conn->prepare("SELECT tbl_dars.name as 'dars name',tbl_quiz.name as 'quiz name',tbl_quiz.level , tbl_quiz.id FROM tbl_dars,tbl_quiz,tbl_admin
        //     WHERE tbl_dars.id= tbl_quiz.dars_id and tbl_quiz.admin_id = tbl_admin.id and tbl_admin.ismodir = 0 and tbl_dars.name = :dars and tbl_admin.id = :iddabir");
        //      $stmt->bindParam(':dars', $d['darsname']);
        //      $stmt->bindParam(':iddabir',$result1[0]['id']);
        //     $stmt->execute();

        //     // set the resulting array to associative

        //     $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //     if($rs){



        //             $data = json_encode([$rs]);



        //     }
        //     else{
        //         $data = json_encode(["message" => null ]);

        //     }
        // }

        // if(isset($d['filter']['level'])){

        //     $stmt = $conn->prepare("SELECT tbl_dars.name as 'dars name',tbl_quiz.name as 'quiz name',tbl_quiz.level , tbl_quiz.id FROM tbl_dars,tbl_quiz,tbl_admin
        // WHERE tbl_dars.id= tbl_quiz.dars_id and tbl_quiz.admin_id = tbl_admin.id and tbl_admin.ismodir = 0 and  tbl_quiz.level = :level and tbl_admin.id = :iddabir");
        //  $stmt->bindParam(':level', $d['filter']['level']);
        //  $stmt->bindParam(':iddabir',$result1[0]['id']);
        // $stmt->execute();

        // // set the resulting array to associative

        // $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // if($rs){



        //         $data = json_encode([$rs]);
        // }
        // else{
        //     $data = json_encode(["message" => null ]);

        // }
        // }
        // else{
        //     $stmt = $conn->prepare("SELECT tbl_dars.name as 'dars name',tbl_quiz.name as 'quiz name',tbl_quiz.level , tbl_quiz.id FROM tbl_dars,tbl_quiz,tbl_admin
        // WHERE tbl_dars.id= tbl_quiz.dars_id and tbl_quiz.admin_id = tbl_admin.id and tbl_admin.ismodir = 0 and tbl_admin.id = :iddabir");

        //  $stmt->bindParam(':iddabir',$result1[0]['id']);
        // $stmt->execute();

        // // set the resulting array to associative

        // $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // if($rs){



        //         $data = json_encode([$rs]);



        // }
        // else{
        //     $data = json_encode(["message" => null ]);

        // }
        // }

        $stmt = $conn->prepare("SELECT tbl_dars.name as 'dars name',tbl_quiz.name as 'quiz name',tbl_quiz.level , tbl_quiz.id FROM tbl_dars,tbl_quiz,tbl_admin
         WHERE tbl_dars.id= tbl_quiz.dars_id and tbl_quiz.admin_id = tbl_admin.id and tbl_admin.ismodir = 0  and tbl_admin.id = :iddabir");

        $stmt->bindParam(':iddabir', $result1[0]['id']);
        $stmt->execute();

        // set the resulting array to associative

        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($rs) {



            $data = json_encode([$rs]);
        } else {
            $data = json_encode(["message" => null]);
        }
    } else {
        $data = json_encode(["message" => "not dabir found"]);
    }
    if (isset($data)) {
        print_r($data);
    }
}
