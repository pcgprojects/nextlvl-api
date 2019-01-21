<?php
namespace spa\V1\Rest\Models;

use Zend\Db\Sql\Select;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Db\Adapter\Driver\DriverInterface;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;


class EmailMapper
{

    protected $adapter;
    protected $table_name;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function sendEmailService($data_user,$config){
            try {

                $display_name = $data_user['names'].' '.$data_user['ape_pat'].' '.$data_user['ape_mat'].' ';

                $display_name = mb_strtoupper($display_name, 'UTF-8');

                $html_body = ' 
                
                <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td align="center">NEXT LEVEL</td>
                </tr> 
                <tr>
                  <td>
                  <br>
                    Estimado(a) <b> '.$display_name.' </b> bienvenido a Next Level Salon & Barber Shop 
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>
                     Desde ahora podrás visualizar nuestras promociones y tu saldo acumulado ingresando con las siguientes credenciales.
                    </p> 
                    <p>
                    <b>Usuario</b>: '.$data_user["nro_doc"].'
                    </p>
                    <p>
                    <b>Password</b>: '.$data_user["password"].'
                    </p>
                  </td>
                </tr>
        </table>
';

                $message = new Message();
                $message->setEncoding("UTF-8");

                $html = new MimePart($html_body);
                $html->type = "text/html";

                $body = new MimeMessage();
                $body->setParts(array($html));
                $message->addTo($data_user['email'])
                        ->addFrom('ocquerevalu@gmail.com', 'Next lvl')
                        ->setSubject('Creación de usuario - Next Level')
                        ->setBody($body);

                $config_server = $config['email_server'];
                $transport = new SmtpTransport();
                $transport->setOptions(new SmtpOptions($config_server));
                $transport->send($message);
            } catch (\Exception $ex) {
                return array('id' => -100, 'msg' => 'Error al enviar correo.');
            }
    }

}
