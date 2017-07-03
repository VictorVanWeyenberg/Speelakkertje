<?php

?>
  <!-- page content -->
<section class="right_col" role="main">
         <div>
           <div class="row top_tiles">
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                 <div class="count"><?php echo $data['present_vandaag']['vm']; ?> </div>
                 <h3>Voormiddag</h3>
                 <p>Aantal kinderen aanwezig voormiddag</p>
               </div>
             </div>
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-comments-o"></i></div>
                 <div class="count"><?php echo $data['present_vandaag']['nm']; ?></div>
                 <h3>Volle dag</h3>
                 <p>Aantal kinderen aanwezig volle dag</p>
               </div>
             </div>
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                 <div class="count"><?php echo $data['present_vandaag']['vd']; ?></div>
                 <h3>Namiddag</h3>
                 <p>Aantal kinderen aanwezig namiddag</p>
               </div>
             </div>
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-check-square-o"></i></div>
                 <div class="count"><?php echo $data['present_vandaag']['tot']; ?></div>
                 <h3>Totaal</h3>
                 <p>Aantal kinderen vandaag aanwezig</p>
               </div>
             </div>
           </div>

          </div>
           <div class="row tile_count">
             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
               <span class="count_top"><i class="fa fa-clock-o"></i> Nieuw vandaag</span>
               <div class="count "><?php echo $data['register_vandaag']; ?></div>
             </div>
             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
               <span class="count_top"><i class="fa fa-user"></i> Nieuw Gisteren</span>
               <div class="count "><?php echo $data['register_yesterday']; ?></div>
             </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Totaal kinderen</span>
                <div class="count green"><?php echo $data['kinderen_totaal']; ?></div>
                <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Totaal Gisteren</span>
                  <div class="count green"><?php echo $data['present_yesterday']['tot']; ?></div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Gisteren Volle dag</span>
                <div class="count"><?php echo $data['present_yesterday']['vd']; ?></div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Gisteren Halve dag</span>
                <div class="count"><?php echo $data['present_yesterday']['vm'] + $data['present_yesterday']['nm'] ; ?></div>
              </div>


            </div>
            <!-- <div class="well" style="overflow: auto">
              <div class="daterangepicker dropdown-menu ltr single opensright show-calendar picker_2 xdisplay"><div class="calendar left single" style="display: block;"><div class="daterangepicker_input"><input class="input-mini form-control active" type="text" name="daterangepicker_start" value="" style="display: none;"><i class="fa fa-calendar glyphicon glyphicon-calendar" style="display: none;"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"><table class="table-condensed"><thead><tr><th class="prev available"><i class="fa fa-chevron-left glyphicon glyphicon-chevron-left"></i></th><th colspan="5" class="month">Oct 2016</th><th class="next available"><i class="fa fa-chevron-right glyphicon glyphicon-chevron-right"></i></th></tr><tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr></thead><tbody><tr><td class="weekend off available" data-title="r0c0">25</td><td class="off available" data-title="r0c1">26</td><td class="off available" data-title="r0c2">27</td><td class="off available" data-title="r0c3">28</td><td class="off available" data-title="r0c4">29</td><td class="off available" data-title="r0c5">30</td><td class="weekend available" data-title="r0c6">1</td></tr><tr><td class="weekend available" data-title="r1c0">2</td><td class="available" data-title="r1c1">3</td><td class="available" data-title="r1c2">4</td><td class="available" data-title="r1c3">5</td><td class="available" data-title="r1c4">6</td><td class="available" data-title="r1c5">7</td><td class="weekend available" data-title="r1c6">8</td></tr><tr><td class="weekend available" data-title="r2c0">9</td><td class="available" data-title="r2c1">10</td><td class="available" data-title="r2c2">11</td><td class="available" data-title="r2c3">12</td><td class="available" data-title="r2c4">13</td><td class="available" data-title="r2c5">14</td><td class="weekend available" data-title="r2c6">15</td></tr><tr><td class="weekend available" data-title="r3c0">16</td><td class="available" data-title="r3c1">17</td><td class="today active start-date active end-date available" data-title="r3c2">18</td><td class="available" data-title="r3c3">19</td><td class="available" data-title="r3c4">20</td><td class="available" data-title="r3c5">21</td><td class="weekend available" data-title="r3c6">22</td></tr><tr><td class="weekend available" data-title="r4c0">23</td><td class="available" data-title="r4c1">24</td><td class="available" data-title="r4c2">25</td><td class="available" data-title="r4c3">26</td><td class="available" data-title="r4c4">27</td><td class="available" data-title="r4c5">28</td><td class="weekend available" data-title="r4c6">29</td></tr><tr><td class="weekend available" data-title="r5c0">30</td><td class="available" data-title="r5c1">31</td><td class="off available" data-title="r5c2">1</td><td class="off available" data-title="r5c3">2</td><td class="off available" data-title="r5c4">3</td><td class="off available" data-title="r5c5">4</td><td class="weekend off available" data-title="r5c6">5</td></tr></tbody></table></div></div><div class="calendar right" style="display: none;"><div class="daterangepicker_input"><input class="input-mini form-control" type="text" name="daterangepicker_end" value="" style="display: none;"><i class="fa fa-calendar glyphicon glyphicon-calendar" style="display: none;"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"><table class="table-condensed"><thead><tr><th></th><th colspan="5" class="month">Nov 2016</th><th class="next available"><i class="fa fa-chevron-right glyphicon glyphicon-chevron-right"></i></th></tr><tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr></thead><tbody><tr><td class="weekend off available" data-title="r0c0">30</td><td class="off available" data-title="r0c1">31</td><td class="available" data-title="r0c2">1</td><td class="available" data-title="r0c3">2</td><td class="available" data-title="r0c4">3</td><td class="available" data-title="r0c5">4</td><td class="weekend available" data-title="r0c6">5</td></tr><tr><td class="weekend available" data-title="r1c0">6</td><td class="available" data-title="r1c1">7</td><td class="available" data-title="r1c2">8</td><td class="available" data-title="r1c3">9</td><td class="available" data-title="r1c4">10</td><td class="available" data-title="r1c5">11</td><td class="weekend available" data-title="r1c6">12</td></tr><tr><td class="weekend available" data-title="r2c0">13</td><td class="available" data-title="r2c1">14</td><td class="available" data-title="r2c2">15</td><td class="available" data-title="r2c3">16</td><td class="available" data-title="r2c4">17</td><td class="available" data-title="r2c5">18</td><td class="weekend available" data-title="r2c6">19</td></tr><tr><td class="weekend available" data-title="r3c0">20</td><td class="available" data-title="r3c1">21</td><td class="available" data-title="r3c2">22</td><td class="available" data-title="r3c3">23</td><td class="available" data-title="r3c4">24</td><td class="available" data-title="r3c5">25</td><td class="weekend available" data-title="r3c6">26</td></tr><tr><td class="weekend available" data-title="r4c0">27</td><td class="available" data-title="r4c1">28</td><td class="available" data-title="r4c2">29</td><td class="available" data-title="r4c3">30</td><td class="off available" data-title="r4c4">1</td><td class="off available" data-title="r4c5">2</td><td class="weekend off available" data-title="r4c6">3</td></tr><tr><td class="weekend off available" data-title="r5c0">4</td><td class="off available" data-title="r5c1">5</td><td class="off available" data-title="r5c2">6</td><td class="off available" data-title="r5c3">7</td><td class="off available" data-title="r5c4">8</td><td class="off available" data-title="r5c5">9</td><td class="weekend off available" data-title="r5c6">10</td></tr></tbody></table></div></div><div class="ranges" style="display: none;"><div class="range_inputs"><button class="applyBtn btn btn-sm btn-success" type="button">Apply</button> <button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button></div></div></div>

              <div class="col-md-4">
                Date Range Picker
                <form class="form-horizontal">
                  <fieldset>
                    <div class="control-group">
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                          <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control" value="01/01/2016 - 01/25/2016" />
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>

              <div class="col-md-5">
                Datum
                <form class="form-horizontal">
                  <fieldset>
                    <div class="control-group">
                      <div class="controls">
                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                          <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                          <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div> -->

           <div class="row">
             <div class="col-md-12">
               <div class="x_panel">
                 <div class="x_title">
                   <h2>Transaction Summary <small>Weekly progress</small></h2>

                   <div class="clearfix"></div>
                 </div>
                 <div class="x_content" style="padding: 1rem;">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="demo-container" style="height:280px">
                       <div id="chart" class="demo-placeholder"></div>
                     </div>

                     <form action="index.php" method="post">
                       <div class="form-group">
                         <label class="control-label col-md-2 col-sm-3 col-xs-12" hidden for="jaar">jaar:</label>
                           <div class="col-md-1 col-sm-3 col-xs-12">
                             <select class="form-control" name="jaar" id="jaar">
                               <?php for ($i = date("Y") ; $i >= 2016; $i--): ?>
                                 <option value="<?php echo $i ?>"
                                   <?php if (isset($_GET["jaar"])): if($_GET["jaar"] == $i): echo "selected"; endif; endif; ?>
                                   <?php if (isset($_POST["jaar"])): if($_POST["jaar"] == $i): echo "selected"; endif; endif; ?>
                                  ><?php echo $i ?></option>
                               <?php endfor; ?>
                             </select>
                           </div>
                       </div>
                       <button type="submit" class="btn btn-round btn-primary">Kies jaar</button>
                     </form>

                   </div>

                 </div>
               </div>
             </div>
           </div>

</section>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts-all-3.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
<!-- <script type="text/javascript" src="js/grafic.js"></script> -->
