<?php
if(isset($_POST['name'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "ricardo.aranamoreno@gmail.com";
    $email_subject = "Portafolio Contacto";


    function died($error) {
        // your error code can go here
        echo "Lo lamento mucho, se encontraron errores en el formulario que intentó enviar.";
        echo "Estos errores aparecen a continuación<br/><br />";
        echo $error."<br /><br />";
        echo "Por favor intentelo de nuevo.<br /><br />";
        die();
    }

    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['asunto']) ||
        !isset($_POST['message'])) {
        died('Lo siento mucho, hay un error en el formulario que intentó enviar');       
    }

    $name = $_POST['name']; // required
    $email = $_POST['email']; // not required
    $asunto = $_POST['asunto']; // not required
    $message = $_POST['message']; // required

    $error_message = "";
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'El nombre que ingresó no parece ser válido.<br />';
  }
  if(strlen($message) < 2) {
    $error_message .= 'Los comentarios que ingresó no parecen ser válidos.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Datos de formulario:.\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "name: ".clean_string($name)."\n";
    $email_message .= "email: ".clean_string($email)."\n";
    $email_message .= "asunto: ".clean_string($asunto)."\n";
    $email_message .= "message: ".clean_string($message)."\n";


// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
echo (int) mail($email_to, $email_subject, $email_message, $headers);  
?>

Gracias por contactarte conmigo, te responderé lo más pronto posible.

<?php
}
?>