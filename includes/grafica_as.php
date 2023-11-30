<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<?php include('../includes/bd.php'); 
$query = "SELECT nom_par, sum(vot_can_for) as vot_cang FROM formularios, 
candidatos, partidos WHERE formularios.id_can = candidatos.id_can AND
candidatos.id_par = partidos.id_par AND car_for= 'Asamblea'
GROUP BY nom_par ORDER BY vot_cang";
$stmt = $conexion->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?> 

<canvas id="myChart" style="position: sticky; top: 100px" height="295"></canvas>
<script>
var candidatosAS = <?php echo json_encode($data); ?>

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: candidatosAS.map(item => item.nom_par),
    datasets: [{
      backgroundColor: candidatosAS.map((item, index) => getRandomColor(index)),
      data: candidatosAS.map(item => item.vot_cang)
    }]
  },
  options: {
    title: {
      display: true,
      text: "Resultados Elecciones 2023"
    }
  }
});
function getRandomColor(index) {
  // Puedes personalizar la generación de colores según tu preferencia
  const hue = (index * 137.508) % 360;
  return `hsl(${hue}, 70%, 60%)`;
};
</script>