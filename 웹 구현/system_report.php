<HTML>
    <HEAD>
        <TITLE>환자수</TITLE>
        <SCRIPT src="https://cdn.jsdelivr.net/npm/chart.js"></SCRIPT>
        <STYLE>
            body {
                font-family: Arial, sans-serif;
                background-color: #BEE5BF;
            }

            .container {
                display: flex;
                padding: 20px;
            }
    
            .list-card {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                flex: 0 0 300px;
                margin-right: 20px;
                padding: 20px;
                padding-bottom: 2%;
            }

            .list-card h3 {
                margin-top: 0;
                margin-bottom: 10px;
            }

            .title-card {
                background-color: #056608;
                color: #FFD700;
                text-align: center;
                border-radius: 8px;
                margin-bottom: 20px;
                padding: 10px;
            }

            .sub-card {
                background-color: #D2F5C4;
                border-radius: 8px;
                margin-top: 50px;
                margin-bottom: 30px;
                padding: 10px;
            }

            .sub-card2 {
                background-color: #f2f2f2;
                border-radius: 8px;
                margin-top: 50px;
                margin-bottom: 30px;
                padding: 10px;
            }

            .sub-card h4 {
                margin-top: 0;
                margin-bottom: 10px;
            }

            .chart-card {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                flex: 1;
                padding: 20px;
            }

            .chart-card h3 {
                margin-top: 0;
                margin-bottom: 10px;
            }

            .chart-container {
                text-align: center;
                margin-top: 30px;
                margin-bottom: 20px;
            }

            .chart {
                margin-bottom: 20px;
            }

            table {
                border-collapse: collapse;
                margin: 0 auto;
                width: 100%;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
            }
        </STYLE>
    </HEAD>
    <BODY>
    <DIV class="container">
        <DIV class="list-card">
            <DIV class="title-card">
                <h2>EWHA HOSPITAL</h2>
                <h3>MANAGEMENT SYSTEM</h3>
            </DIV>
            <h4 style="text-align: center;">[2023.05.01(MON) ~ 2023.05.12(FRI)]</h4>
            <DIV class="sub-card2">
                <a href="Patient_Info.php" style="text-decoration: none; color: #056608; font-weight: bold; font-size: 20px; display: block; text-align: center;">환자병원 진료정보</a>
            </DIV>
            <DIV class="sub-card">
                <a href="system_report.php" style="text-decoration: none; color: #056608; font-weight: bold; font-size: 20px; display: block; text-align: center;">분석보고서</a>
            </DIV>
            <DIV style="display: flex; justify-content: center; align-items: center; margin-top: 35px;">
                <img src="/homework2/이화교표.png" alt="이화여자대학교 교표">
            </DIV>

        </DIV>

        <?php
        $servername = "localhost";
        $username = "lny";
        $password = "0825";
        $dbname = "company";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            echo "Database connection error: " . mysqli_connect_error();
            exit();
        }

        $genderQuery = "SELECT P.SEX, COUNT(P.NAME) AS PATIENT_COUNT
                        FROM PATIENT P
                        GROUP BY P.SEX";

        $genderResult = mysqli_query($conn, $genderQuery);

        $genderData = array();
        $genderLabels = array();

        while ($row = mysqli_fetch_assoc($genderResult)) {
            $genderLabels[] = $row['SEX'];
            $genderData[] = $row['PATIENT_COUNT'];
        }

        mysqli_free_result($genderResult);

        $deptQuery = "SELECT D.DEPTNAME, COUNT(P.NAME) AS PATIENT_COUNT
                        FROM DOCTOR D
                        LEFT JOIN PATIENT P ON P.DOC_ID = D.DOC_ID
                        GROUP BY D.DEPTNAME";

        $deptResult = mysqli_query($conn, $deptQuery);

        $deptData = array();
        $deptLabels = array();
        $deptColors = array();

        $colors = array('rgba(255, 143, 116, 0.7)', 'rgba(178, 223, 138, 0.7)', 'rgba(187, 225, 250, 0.7)', 'rgba(255, 206, 86, 0.7)', 'rgba(168, 133, 255, 0.7)');

        while ($row = mysqli_fetch_assoc($deptResult)) {
            $deptLabels[] = $row['DEPTNAME'];
            $deptData[] = $row['PATIENT_COUNT'];
            $deptColors[] = array_shift($colors);
        }

        mysqli_free_result($deptResult);
        mysqli_close($conn);
        ?>

        <DIV class="chart-card">
            <h3>성별 환자 현황</h3>
            <DIV class="chart-container">
                <CANVAS id="genderChart"></CANVAS>
            </DIV>
            <TABLE>
                <THEAD>
                    <TR>
                        <TH>성별</TH>
                        <TH>환자 수</TH>
                    </TR>
                </THEAD>
                <TBODY>
                    <?php
                    for ($i = 0; $i < count($genderLabels); $i++) {
                        echo "<tr>";
                        echo "<td>".$genderLabels[$i]."</td>";
                        echo "<td>".$genderData[$i]."</td>";
                        echo "</tr>";
                    }
                    ?>
                </TBODY>
            </TABLE>
        </DIV>

        <DIV class="chart-card">
            <h3>진료과목별 환자 현황</h3>
            <DIV class="chart-container">
                <CANVAS id="deptChart"></CANVAS>
            </DIV>
            <TABLE>
                <THEAD>
                    <TR>
                        <TH>진료과목</TH>
                        <TH>환자 수</TH>
                    </TR>
                </THEAD>
                <TBODY>
                    <?php
                    for ($i = 0; $i < count($deptLabels); $i++) {
                        echo "<tr>";
                        echo "<td>".$deptLabels[$i]."</td>";
                        echo "<td>".$deptData[$i]."</td>";
                        echo "</tr>";
                    }
                    ?>
                </TBODY>
            </TABLE>
        </DIV>
    </DIV>

    <SCRIPT>
        var genderData = <?php echo json_encode($genderData); ?>;
        var genderLabels = <?php echo json_encode($genderLabels); ?>;

        var deptData = <?php echo json_encode($deptData); ?>;
        var deptLabels = <?php echo json_encode($deptLabels); ?>;
        var deptColors = <?php echo json_encode($deptColors); ?>;
    
        var genderChartCanvas = document.getElementById('genderChart');
        var deptChartCanvas = document.getElementById('deptChart');

        new Chart(genderChartCanvas, {
            type: 'doughnut',
            data: {
                labels: genderLabels,
                datasets: [{
                    data: genderData,
                    backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        new Chart(deptChartCanvas, {
            type: 'bar',
            data: {
                labels: deptLabels,
                datasets: [{
                    data: deptData,
                    backgroundColor: deptColors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                aspectRatio: 1.1
            }
        });
    </SCRIPT>
    <h4 style="text-align: right;">2조 - 곽선호 김민영 배소현 유서현 이나영</h4>
    </BODY>
</HTML>

