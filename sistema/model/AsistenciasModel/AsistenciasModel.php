    <?php
    require_once __DIR__ . '/../conexion.php';

    class Asistencias extends Database {
        public function obtenerEmpleados() {
            $sql = "SELECT idEmpleado, nombres FROM empleados";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function obtenerEmpleadosSinEntradaSinPermiso($fecha)
        {
            $sql = "SELECT idEmpleado FROM empleados 
                    WHERE idEmpleado NOT IN (
                        SELECT idEmpleado FROM asistencia WHERE fechaRegistro = :fecha
                    )
                    AND idEmpleado NOT IN (
                        SELECT idEmpleado FROM permisos WHERE fechaInicio <= :fecha AND fechaFin >= :fecha
                    )
                    AND idEmpleado NOT IN (
                        SELECT idEmpleado FROM exoneraciones WHERE fecha = :fecha
                    )";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function obtenerEmpleadosConEntrada($fecha) {
            $sql = "SELECT e.idEmpleado, e.nombres, 
                        CASE WHEN a.minutos_tardanza > 0 THEN 'Tardanza' ELSE 'A Tiempo' END AS estado
                    FROM empleados e
                    JOIN asistencia a ON e.idEmpleado = a.idEmpleado
                    WHERE a.fechaRegistro = :fecha AND a.horaEntrada IS NOT NULL";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

         public function obtenerEmpleadosAusentes($fecha) {
            $sql = "SELECT e.idEmpleado, e.nombres
                    FROM empleados e
                    WHERE e.idEmpleado NOT IN (
                        SELECT a.idEmpleado
                        FROM asistencia a
                        WHERE a.fechaRegistro = :fecha AND a.horaEntrada IS NOT NULL
                    )
                    AND e.idEmpleado NOT IN (
                        SELECT p.idEmpleado
                        FROM permisos p
                        WHERE p.fechaInicio <= :fecha AND p.fechaFin >= :fecha
                    )
                    AND e.idEmpleado NOT IN (
                        SELECT ex.empleadoId
                        FROM exoneraciones ex
                        WHERE ex.fecha = :fecha
                    )";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function obtenerEmpleadosConFalta($fecha) {
            $sql = "SELECT e.idEmpleado, e.nombres
                    FROM empleados e
                    JOIN asistencia a ON e.idEmpleado = a.idEmpleado
                    WHERE a.fechaRegistro = :fecha AND a.estado = 'falta'";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function registrarFalta($idEmpleado)
        {
            $sql = "INSERT INTO asistencia (idEmpleado, fechaRegistro, estado) VALUES (:idEmpleado, CURDATE(), 'falta')";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $idEmpleado);
            $stmt->execute();
        }
        
         public function registrarEntrada($idEmpleado, $tipoRegistro = 'automatica') {
            $horaEntradaProgramada = $this->obtenerHoraEntradaTurno($idEmpleado);
            $horaActual = date('H:i:s');
            
            $minutos_anticipados = 0;
            $minutos_tardanza = 0;
            
            if ($horaActual < $horaEntradaProgramada) {
                $minutos_anticipados = $this->calcularDiferenciaMinutos($horaActual, $horaEntradaProgramada);
            } elseif ($horaActual > $horaEntradaProgramada) {
                $minutos_tardanza = $this->calcularDiferenciaMinutos($horaEntradaProgramada, $horaActual);
            }

            $sql = "INSERT INTO asistencia (idEmpleado, fechaRegistro, horaEntrada, minutos_anticipados, minutos_tardanza, tipo_registro) 
                    VALUES (:idEmpleado, CURDATE(), CURTIME(), :minutos_anticipados, :minutos_tardanza, :tipo_registro)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $idEmpleado);
            $stmt->bindParam(':minutos_anticipados', $minutos_anticipados);
            $stmt->bindParam(':minutos_tardanza', $minutos_tardanza);
            $stmt->bindParam(':tipo_registro', $tipoRegistro);
            $stmt->execute();
        }

        public function registrarReceso($idEmpleado, $tipoRegistro = 'automatica') {
            $sql = "UPDATE asistencia SET horaReceso = CURTIME(), tipo_registro = :tipo_registro 
                    WHERE idEmpleado = :idEmpleado AND fechaRegistro = CURDATE()";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $idEmpleado);
            $stmt->bindParam(':tipo_registro', $tipoRegistro);
            $stmt->execute();
        }

        public function registrarSalida($idEmpleado, $tipoRegistro = 'automatica') {
            try {
                $sql = "UPDATE asistencia SET horaSalida = CURTIME(), tipo_registro = :tipo_registro 
                        WHERE idEmpleado = :idEmpleado AND fechaRegistro = CURDATE()";
                
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':idEmpleado', $idEmpleado);
                $stmt->bindParam(':tipo_registro', $tipoRegistro);
                $stmt->execute();
                return true; // Asegúrate de que la consulta se ejecute correctamente
            } catch (Exception $e) {
                // Capturar cualquier error y mostrarlo para depuración
                echo 'Error: ' . $e->getMessage();
                return false;
            }
        }
        
        public function verificarSalida($idEmpleado) {
            $sql = "SELECT COUNT(*) FROM asistencia WHERE idEmpleado = :idEmpleado AND fechaRegistro = CURDATE() AND horaSalida IS NOT NULL";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $idEmpleado);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }
        

        public function calcularMinutosReceso($idEmpleado) {
            $sql = "SELECT TIMESTAMPDIFF(MINUTE, horaReceso, CURTIME()) AS minutosReceso 
                    FROM asistencia 
                    WHERE idEmpleado = :idEmpleado AND fechaRegistro = CURDATE() AND horaReceso IS NOT NULL";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $idEmpleado);
            $stmt->execute();
            return $stmt->fetchColumn();
        }

          public function verificarEntrada($idEmpleado) {
            $sql = "SELECT COUNT(*) FROM asistencia WHERE idEmpleado = :idEmpleado AND fechaRegistro = CURDATE() AND horaEntrada IS NOT NULL";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $idEmpleado);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }

              public function verificarReceso($idEmpleado) {
            $sql = "SELECT COUNT(*) FROM asistencia WHERE idEmpleado = :idEmpleado AND fechaRegistro = CURDATE() AND horaReceso IS NOT NULL";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $idEmpleado);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }

               private function obtenerHoraEntradaTurno($idEmpleado) {
            $sql = "SELECT t.entrada FROM turnos t
                    INNER JOIN empleados e ON e.idTurno = t.idTurno
                    WHERE e.idEmpleado = :idEmpleado";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $empleadoId);
            $stmt->execute();
            return $stmt->fetchColumn(); 
        }


        private function calcularDiferenciaMinutos($horaInicio, $horaFin) {
            $inicio = new DateTime($horaInicio);
            $fin = new DateTime($horaFin);
            return $inicio->diff($fin)->i; 
        }
    }
    ?>
