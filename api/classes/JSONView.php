namespace classes\View;

class JSONView extends \Slim\View {

    /**
     * Sets response body of appended data to be json_encoded
     * 
     * @param int $status
     * @param array|null $data
     * @return void
     */
    public function render($status = 200, $data = array()) {

        $data = array_merge(array('status' => $status), $this->all(), is_array($data) ? $data : array());

        if (isset($data['flash']) && is_object($data['flash'])) {
            $flash = $this->data->flash->getMessages();
            if (count($flash)) {
                $data['flash'] = $flash;
            } else {
                unset($data['flash']);
            }
        }

        $app = \Slim\Slim::getInstance();

        $response = $app->response();

        $response->status($status);
        $response->header('Content-Type', 'application/json');
        $response->body(json_encode($data));

        $app->stop();
    }

}