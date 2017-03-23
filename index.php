<?php
    require_once 'Curl.php';

    $is_compact = (isset($_GET['compact'])?:false);

    $curl = new Curl();
    $resume = $curl->request($_GET['json_url']);
    $data = json_decode($resume[1], true);

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
<link rel="stylesheet" type="text/css" href="stylesheets/print.css" media="print">
<link rel="stylesheet" type="text/css" href="stylesheets/bootstrap/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="stylesheets/font-awesome/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:200,200i,300,400,600,700" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resume</title>
</head>
<body>
	<div class="container">
        <div class="left_cont">
        	<div class="image">
            	<img src="<?php echo $data['basics']['picture'];?>" class="img-circle"/>
            </div>
            <div class="description">
                <div class="education">
                    <img style="float: left;width: 34px" src="images/graduation.jpg"/>
					<h2 style="float: right;">Education</h2>
                    <?php foreach ($data['education'] as $item):?>
                    <div class="university">
                    	<p><strong><?php echo $item['course'];?></strong></p>
                        <p><?php echo $item['institution'];?></p>
						<p>(<?php echo $item['startDate'];?> – <?php echo $item['endDate'];?>)</p>
                    </div>
                    <?php endforeach;?>
                </div>
                
                <div class="skills">
                    <img style="float: left;width: 30px" src="images/skills.jpg"/>
					<h2>Skills</h2>
                    <?php if(!$is_compact):?>
                    <div class="languages">
                    	<p><strong>Legend:</strong></p>
                        <p id="legend"><img src="images/skills-green.png"  class="img-circle legend" /><span>Number of years</span></p>
                    </div>

                        <?php foreach ($data['skills'] as $item):?>
                        <div class="languages">
                            <p><strong><?php echo $item['name'];?></strong></p>
                            <ul>
                                <?php for($ctr=0;$ctr<$item['number_of_years'];$ctr++):?>
                                <li><img src="images/skills-green.png"  class="img-circle legend" /></li>
                                <?php endfor;?>
                            </ul>
                        </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <?php foreach ($data['skills'] as $item):?>
                            <div class="languages">
                                <p><strong><?php echo $item['name'];?></strong> <span style="float: right"><?php echo $item['number_of_years'];?> <?php echo ($item['number_of_years']>1)?'years':'year';?></span></p>
                            </div>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
                
            </div>
        </div>
        
        <div class="right_cont">
        	<div class="details" id="name">
                <h1 class="name"><?php echo $data['basics']['name'];?></h1>
                <h3 class="job-title"><?php echo $data['basics']['label'];?></h3>
            </div>
            <div class="details" id="title">
            	<img src="images/work-history.jpg" />
                <h2>Work Experience</h2>
            </div>

            <?php foreach ($data['work'] as $item):?>
            <div class="details" id="work">
                    	<ul class="work">
                            <li class="col-lg-7"><p class="title"><strong><?php echo $item['position'];?></strong></p></li>
                            <li class="col-lg-5 year"><p class="year"><strong><?php echo $item['startDate'];?> - <strong><?php echo $item['endDate'];?></p></li>
                            <li class="col-lg-8"><p><span><?php echo $item['company'];?></span></p></li>
                            <li class="col-lg-12 sub-text"><p><?php echo $item['summary'];?></p></li>
                        </ul>
            </div>
            <?php endforeach;?>


            <?php if(count($data['certification']) > 0):?>
                <div class="details" id="title">
                    <img src="images/certifications.jpg" />
                    <h2>Certifications</h2>
            </div>
            <?php foreach ($data['certification'] as $item):?>
            <div class="details certifications" div id="certificate">
            	<ul>
                	<li>
                    	<p><strong><?php echo $item['title'];?></strong></p>
						<p><?php echo $item['institution'];?></p>
                    </li>
                </ul>
            </div>
            <?php endforeach;?>
            <?php endif;?>
        </div>

   	</div>
</body>
</html>
