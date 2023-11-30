<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<?php include('../includes/bd.php'); 
$query = "SELECT nom_can, sum(vot_can_for) as vot_cang FROM formularios, 
candidatos WHERE formularios.id_can = candidatos.id_can AND car_for= 'Gobernacion' 
GROUP BY nom_can ORDER BY vot_cang";
$stmt = $conexion->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?> 

<canvas id="myChart" style="position: sticky; top: 100px" height="295"></canvas>
<script>
var candidatosG = <?php echo json_encode($data); ?>

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: candidatosG.map(item => item.nom_can),
    datasets: [{
      backgroundColor: candidatosG.map((item, index) => getRandomColor(index)),
      data: candidatosG.map(item => item.vot_cang)
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