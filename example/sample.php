<?php
require_once('../lib/Phirehose.php');
/**
 * NOTE: THIS WORKS.
 * 
 * newshorts - 189069893
 * kadisco - 14923310
 * charusse - 298717298
 * laurahamrick - 63525170
 * megannewt - 191618689
 * loparks - 27108506
 * pedrosorren - 15085420
 * JonisDelicious - 14859090
 * MxMnr - 148559999
 * pkander - 19356301
 * fouhy - 21313187
 * rjduranjr - 238438353
 * 
 */
class SampleConsumer extends Phirehose
{
    
  /**
   * Enqueue each status
   *
   * @param string $status
   */
  public function enqueueStatus($status)
  {
    /*
     * In this simple example, we will just display to STDOUT rather than enqueue.
     * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
     *       enqueued and processed asyncronously from the collection process. 
     */
    $data = json_decode($status, true);
    if (is_array($data) && isset($data['user']['newshorts'])) {
      print $data['user']['newshorts'] . ': ' . urldecode($data['text']) . "\n";
    }
    echo "<pre>";
//    echo $this->getFollow();
    print_r($data);
  }
}

// Start streaming
$sc = new SampleConsumer('newshorts', 'kGD_00bouer', Phirehose::METHOD_FILTER);

/*
 * find out here: http://www.idfromuser.com/
 * 
 * example 1: 302605902 nyandarguard, 284899423 Eidsin, 189069893 newshorts
 */

$users = array("302605902", "284899423", "189069893");

$sc->setFollow($users);

$sc->consume();