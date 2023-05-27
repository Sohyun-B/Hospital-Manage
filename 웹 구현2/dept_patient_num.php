<HTML>
  <HEAD>
    <TITLE>환자수</TITLE>
  </HEAD>
  
  <BODY>
    <?php
    $conn = mysqli_connect("localhost", "lny", "0825", "company");
    if (!$conn) {
        echo "Database connection error";
    } else {
        echo "Database connection success<br><br>";
    }

    if (mysqli_connect_errno()) {
        echo "Could not connect: " . mysqli_connect_error();
        exit();
    }

    $query = "SELECT D.DEPTNAME, COUNT(P.NAME) AS PATIENT_COUNT
        FROM DOCTOR D
        LEFT JOIN PATIENT P ON P.DOC_ID = D.DOC_ID
        GROUP BY D.DEPTNAME";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        ?>
       <TABLE BORDER=1>
            <TR>
                <TH>진료과목</TH>
                <TH>환자 수</TH>
            </TR>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <TR>
                    <TD><?php echo $row['DEPTNAME']; ?></TD>
                    <TD><?php echo $row['PATIENT_COUNT']; ?></TD>
                </TR>
                <?php
            }
            ?>
        </TABLE>
        <?php
    } else {
        echo "No results found.";
    }

    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
  </BODY>
</HTML>
