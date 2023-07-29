<?php
namespace App\Services;

require '..\vendor\autoload.php';

use Kreait\Firebase\Factory;

class FirebaseService
{
    private $firebase;
    private $db;

    public function __construct() {
        $this->firebase = (new Factory)->withServiceAccount('../key/cofinbot-bmvt-f1d6cd788152.json');
        $this->db = $this->firebase->createDatabase();
    }

    public function correo()
    {
        $refernce = $this->db->getReference('datos');
        $registros = $refernce->getValue();
        return $registros;
    }
    
    public function eliminarCorreo($cor)
    {
        $refernce = $this->db->getReference('datos');
        $snapshot = $refernce->getSnapshot();
        $data = $snapshot->getValue();

        // Buscar el correo en los datos
        $keyToDelete = null;
        foreach ($data as $key => $value) {
            if ($value['correo'] === $cor) {
                $keyToDelete = $key;
                break;
            }
        }

        // Eliminar el dato correspondiente al correo
        if ($keyToDelete !== null) {
            $refernce->getChild($keyToDelete)->remove();
        }
    }
}
?>