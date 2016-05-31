<?php

namespace Idevels\Package;

class User extends TestRail {

  /**
   * @param $user_id
   * @return \Psr\Http\Message\StreamInterface
   */
  public function getUser($user_id) {
    return $this->apiCall('get_user', 'GET', array(
      'query' => array(
        'user_id' => $user_id
      )
    ));
  }

  /**
   * @param $email
   * @return \Psr\Http\Message\StreamInterface
   */
  public function getUserByEmail($email) {
    return $this->apiCall('get_user_by_email', 'GET', array(
      'query' => array(
        'email' => $email
      )
    ));
  }

  /**
   * Returns a list of users.
   */
  public function getUsers() {
    return $this->apiCall('get_users', 'GET', array());
  }

}
