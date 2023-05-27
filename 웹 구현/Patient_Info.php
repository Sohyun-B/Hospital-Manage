<HTML>
    <HEAD>
        <TITLE>환자정보</TITLE>
    </HEAD>

    <BODY>
        <form method="GET">
            <label for="username">환자 이름:</label>
            <input type="text" id="username" name="username">
            <input type="submit" value="검색">
        </form>

        <?php
        $conn = mysqli_connect("localhost", "ryuryu", "1234", "hospital_management");
        if (!$conn) {
            echo "Database connection error";
        } else {
            echo "Database connection success";
        }

        if (mysqli_connect_errno()) {
            echo "Could not connect: " . mysqli_connect_error();
            exit();
        }

        if (isset($_GET['username'])) {
            $username = $_GET['username'];
            $query = "SELECT P.NAME, C.CHART_NO, P.PATIENT_ID, P.DOC_ID, P.NURSE_ID, T.DATE, T.CONTENTS, C.DOC_OPINION, P.SEX, P.SOCIALNUM, P.ADDRESS, P.PHONENUM, P.JOB, P.EMAIL
                FROM PATIENT P
                JOIN TREATMENT T ON P.PATIENT_ID = T.PATIENT_ID
                JOIN CHART C ON P.PATIENT_ID = C.PATIENT_ID
                WHERE P.NAME = '$username'";

            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                ?>
                <TABLE BORDER=1>
                    <TR>
                        <TD>환자이름</TD>
                        <TD>차트번호</TD>
                        <TD>환자ID</TD>
                        <TD>담당의사ID</TD>
                        <TD>담당간호사ID</TD>
                        <TD>진료날짜</TD>
                        <TD>진료내용</TD>
                        <TD>의사소견</TD>
                        <TD>환자성별</TD>
                        <TD>환자주민번호</TD>
                        <TD>환자주소</TD>
                        <TD>환자전화번호</TD>
                        <TD>환자직업</TD>
                        <TD>환자이메일</TD>
                    </TR>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
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
                            <TD><?php echo $row['SEX']; ?></TD>
                            <TD><?php echo $row['SOCIALNUM']; ?></TD>
                            <TD><?php echo $row['ADDRESS']; ?></TD>
                            <TD><?php echo $row['PHONENUM']; ?></TD>
                            <TD><?php echo $row['JOB']; ?></TD>
                            <TD><?php echo $row['EMAIL']; ?></TD>
                        </TR>
                    <?php } ?>
                </TABLE>
            <?php
            } else {
                echo "No results found for the provided username.";
            }

            mysqli_free_result($result);
        }

        mysqli_close($conn);
        ?>
    </BODY>
</HTML>
