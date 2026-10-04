<?php

namespace App\Models;

class PacienteModel extends Model {
    protected $table = 'fich_paciente';
    protected $primaryKey = 'id';

    public function obtenerExpedienteCompleto($id) {
        // Cambiamos f.numExpediente por f.id para que coincida con tu SQL
        $sql = "SELECT f.*, 
                       h.alergias, h.habitos, h.motivo, h.HEA, h.indicMedicas, h.AHF, h.APP,
                       p.nombre AS nombre_medico, p.numJuntaVigilancia, p.colegiacionMed
                FROM fich_paciente f
                LEFT JOIN hist_paciente h ON f.id = h.id
                LEFT JOIN personal p ON f.id_personal = p.id_personal
                WHERE f.id = '{$id}'
                ORDER BY h.id DESC LIMIT 1";

        return $this->query($sql)->first();
    }
}