<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 06-May-18
 * Time: 5:27 PM
 */


/********************
 *
 * Users Information
 */

$today = date('Y-m-d');


//count all register users
$data['countAllUsers'] = $this->db->count_all_results('userz');

//get pending userz
$this->db->where("status ='1'");
$data['countPendingUsers'] = $this->db->count_all_results('userz');

//get disqualified userz
$this->db->where("status ='2'");
$data['countDisqualifiedUsers'] = $this->db->count_all_results('userz');

//fetch all users
$data['getAllusers'] = $this->db->get('userz')->result_array();

/********************
 *
 * Contest Information
 */

//count all contests
$data['countAllContest'] = $this->db->count_all_results('contests');

//count close contests
$this->db->where("contest_status ='1'");
$data['countCloseContests'] = $this->db->count_all_results('contests');

//get all contests
$data['getAllcontests'] = $this->db->get('contests')->result_array();

//get all closed contest
$this->db->where("contest_status ='1'");
$data['getAllcontests'] = $this->db->get('contests')->result_array();

/********************
 *
 * Challenges Information
 *
 */

//count all challenges
$data['countAllChallenges'] = $this->db->count_all_results('challenges');

//get close challenges
$this->db->where("status = '1'");
$data['countCloseChallenges'] = $this->db->count_all_results('challenges');

//get All challenges
$this->db->get('challenges')->result_array();

/********************
 *
 * Vote Information
 *
 */

$data['countTotalVote'] = $this->db->count_all_results('votex');

//count all contest available for vote
$realDate = date('Y-m-d');

//$this->db->where("vote_start_date >= '$vote_start_date'  && vote_end_date >= '$vote_end_date' ");
//count all open vote contest
$this->db->where("type='contest' AND vote_end_date >'$today' AND status='0'");
$data['countOpenVote'] = $this->db->count_all_results('vote_information');



//$getVoteInformation = $this->db->get('vote_information')->result_array();
/*foreach($getVoteInformation as $voteInfo){

    $vote_start_date = $voteInfo['vote_start_date'];
    $vote_end_date = $voteInfo['vote_end_date'];



    // echo  $countOpenVote['vote_start_date'] .' - '.$countOpenVote['vote_end_date'] .'<br>';

}
*/






/********************
 *
 * Photo and video upload
 *
 */

$data['countPhoto'] = $this->db->count_all_results('uploads');


