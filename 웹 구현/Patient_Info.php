<HTML>
    <HEAD>
        <TITLE>환자정보</TITLE>
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
                background-color: #f2f2f2;
                border-radius: 8px;
                margin-top: 50px;
                margin-bottom: 30px;
                padding: 10px;
            }
            .sub-card2 {
                background-color: #f2f2f2;
                border-radius: 8px;
                margin-bottom: 30px;
                padding: 10px;
            }
            .sub-card3 {
                background-color: #D2F5C4;
                border-radius: 8px;
                margin-top: 50px;
                margin-bottom: 30px;
                padding: 10px;
            }
            .subtitle-card {
                background-color: #056608;
                color: #ffffff;
                text-align: center;
                border-radius: 10px;
                margin-top: 30px;
                margin-bottom: 20px;
                width: 150px;
                padding-top: 10px;
                padding-bottom: 5px;
            }
            .subtitle-card2 {
                background-color: #056608;
                color: #ffffff;
                text-align: center;
                border-radius: 10px;
                margin-top: 30px;
                margin-bottom: 20px;
                width: 200px;
                padding-top: 10px;
                padding-bottom: 5px;
            }
            .search-result-card {
                flex: 1;
            }

            .result-table {
                width: 100%;
                border-collapse: collapse;
            }

            .result-table th {
                background-color: #f2f2f2;
                padding: 8px;
                text-align: center;
                border: 1px solid #ddd;
            }
            .result-table td {
                padding: 8px;
                text-align: center;
                border: 1px solid #ddd;
            }

            .no-results-message {
                text-align: center;
                color: #FF0000;
                font-weight: bold;
                margin-top: 120px;
            }
            .search-form {
                display: flex;
                align-items: center;
            }

            .search-label {
                font-weight: bold;
                margin-right: 10px;
                margin-top: 10px;
                margin-left: 5px;
            }

            .search-input-wrapper {
                display: flex;
                align-items: center;
                margin-top: 10px;
            }

            .search-input {
                padding: 6px 10px;
                border-radius: 4px;
                border: 1px solid #ccc;
            }

            .search-button {
                padding: 6px 10px;
                border-radius: 4px;
                background-color: #056608;
                color: #fff;
                border: none;
                cursor: pointer;
                margin-left: 15px;
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
                <DIV class="sub-card3">
                    <a href="Patient_Info.php" style="text-decoration: none; color: #056608; font-weight: bold; font-size: 20px; display: block; text-align: center;">환자병원 진료정보</a>
                </DIV>
                <DIV class="sub-card">
                    <a href="system_report.php" style="text-decoration: none; color: #056608; font-weight: bold; font-size: 20px; display: block; text-align: center;">분석보고서</a>
                </DIV>
                <DIV style="display: flex; justify-content: center; align-items: center; margin-top: 35px;">
                    <img src="/homework2/이화교표.png" alt="이화여자대학교 교표">
                </DIV>
            </DIV>

            <DIV class="list-card search-result-card">
                <DIV class="sub-card2">
                    <FORM method="GET" class="search-form">
                        <LABEL for="username" class="search-label">환자 이름:</LABEL>
                        <DIV class="search-input-wrapper">
                            <input type="text" id="username" name="username" class="search-input">
                            <BUTTON type="submit" class="search-button">검색</BUTTON>
                        </DIV>
                    </FORM>
                </DIV>
                <?php
                $conn = mysqli_connect("localhost", "lny", "0825", "company");

                if (mysqli_connect_errno()) {
                    echo "Could not connect: " . mysqli_connect_error();
                    exit();
                }

                if (isset($_GET['username'])) {
                    $username = $_GET['username'];
                    $query = "SELECT P.NAME, P.PATIENT_ID, P.SEX, P.SOCIALNUM, P.ADDRESS, P.PHONENUM, P.JOB, P.EMAIL
                        FROM PATIENT P
                        WHERE P.NAME = '$username'";

                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        ?>
                        <DIV class="subtitle-card">
                            <h3>환자 정보</h3>
                        </DIV>
                        <DIV>
                            <TABLE class="result-table">
                                <TR>
                                    <TH>환자이름</TH>
                                    <TH>환자ID</TH>
                                    <TH>환자성별</TH>
                                    <TH>환자주민번호</TH>
                                    <TH>환자주소</TH>
                                    <TH>환자전화번호</TH>
                                    <TH>환자직업</TH>
                                    <TH>환자이메일</TH>
                                </TR>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <TR>
                                        <TD><?php echo $row['NAME']; ?></TD>
                                        <TD><?php echo $row['PATIENT_ID']; ?></TD>
                                        <TD><?php echo $row['SEX']; ?></TD>
                                        <TD><?php echo $row['SOCIALNUM']; ?></TD>
                                        <TD><?php echo $row['ADDRESS']; ?></TD>
                                        <TD><?php echo $row['PHONENUM']; ?></TD>
                                        <TD><?php echo $row['JOB']; ?></TD>
                                        <TD><?php echo $row['EMAIL']; ?></TD>
                                    </TR>
                                <?php } ?>
                            </TABLE>
                        </DIV>
                    <?php
                    }
                    mysqli_free_result($result);

                    $query2 = "SELECT P.NAME, C.CHART_NO, P.PATIENT_ID, P.DOC_ID, P.NURSE_ID, T.DATE, T.CONTENTS, C.DOC_OPINION
                        FROM PATIENT P
                        JOIN TREATMENT T ON P.PATIENT_ID = T.PATIENT_ID
                        JOIN CHART C ON P.PATIENT_ID = C.PATIENT_ID
                        WHERE P.NAME = '$username'";

                    $result2 = mysqli_query($conn, $query2);

                    if ($result2 && mysqli_num_rows($result2) > 0) {
                        ?>
                        <DIV class="subtitle-card2">
                            <h3>진료 및 차트 정보</h3>
                        </DIV>
                        <DIV>
                            <TABLE class="result-table">
                                <TR>
                                    <TH>환자이름</TH>
                                    <TH>차트번호</TH>
                                    <TH>환자ID</TH>
                                    <TH>담당의사ID</TH>
                                    <TH>담당간호사ID</TH>
                                    <TH>진료날짜</TH>
                                    <TH>진료내용</TH>
                                    <TH>의사소견</TH>
                                </TR>
                                <?php
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    ?>
                                    <TR>
                                        <TD><?php echo $row['NAME']; ?></TD>
                                        <TD><?php echo $row['CHART_NO']; ?></TD>
                                        <TD><?php echo $row['PATIENT_ID']; ?></TD>
                                        <TD><?php echo $row['DOC_ID']; ?></TD>
                                        <TD><?php echo $row['NURSE_ID']; ?></TD>
                                        <TD><?php echo $row['DATE']; ?></TD>
                                        <TD><?php echo $row['CONTENTS']; ?></TD>
                                        <TD><?php echo $row['DOC_OPINION']; ?></TD>
                                    </TR>
                                <?php } ?>
                            </table>
                        </DIV>
                    <?php
                    } else {
                        echo '<div><p class="no-results-message">해당 환자에 대한 정보가 없습니다.</p></DIV>';
                    }

                    mysqli_free_result($result2);
                }

                mysqli_close($conn);
                ?>
            </DIV>
        </DIV>
        <h4 style="text-align: right;">2조 - 곽선호 김민영 배소현 유서현 이나영</h4>
    </BODY>
</HTML>

