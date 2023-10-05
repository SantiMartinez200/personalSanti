<?php
require("../BD/conn.php");
require("../Clases/Persona.php");
require("../Clases/Alumno.php");
$conectarDB = new Conexion();
$columns = ['ast.id', 'a.dni', 'a.nombre', 'a.apellido', 'ast.fecha_asistencia', 'r.rol'];
$table = "((alumno AS a INNER JOIN asistencia as ast ON a.dni=ast.dni) INNER join rol_persona AS r ON a.dni=r.dni)";
$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;
$where = '';
if ($campo != null) {
  $where = "WHERE (";
  $cont = count($columns);
  for ($i = 0; $i < $cont; $i++) {
    $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
  }
  $where = substr_replace($where, "", -3);
  $where .= ")";
}
$filterQuery = "SELECT " . implode(", ", $columns) . " FROM $table";
$resultado = $conectarDB->ejecutar($filterQuery);
$num_rows = $resultado->num_rows;
$html = "";
if ($num_rows > 0) {
  while ($row = $resultado->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['id'] . '</td>';
    $html .= '<td>' . $row['dni'] . '</td>';
    $html .= '<td>' . $row['nombre'] . '</td>';
    $html .= '<td>' . $row['apellido'] . '</td>';
    $html .= '<td>' . $row['fecha_asistencia'] . '</td>';
    $html .= '<td>' . $row['rol'] . '</td>';
    $html .= '</tr>';
  }
} else {
  $html .= '<tr>';
  $html .= '<td colspan="6">Sin Resultados</td>';
  $html .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>