<?php
require_once('../lib/Phirehose.php');
/**
 * Example of using Phirehose to display the 'sample' twitter stream. 
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
  }
}

// Start streaming
$sc = new SampleConsumer('newshorts', 'kGD_00bouer', Phirehose::METHOD_SAMPLE);
$sc->consume();