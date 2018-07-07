{#INCLUDE:header}
	<body>
		{#INCLUDE:header[LOGOUT]}
		<div id="container">

			<div class="wrapper">
				{#INCLUDE:sidebar}
				<div id="content">

					<div class="article">
						<!--
                        <div id="warn-info">With our unique <a href="https://norebirth.com/topic/927--x20-progressive-content/">progressive system</a> it's never too late to join the  server!</div>
-->
						<h2><i class="icons icon-ratings"></i>Rankings</h2>
						<div class="spacer3"></div>
						<div class="main">

							<div class="tabs">
								<!--
    <ul>
          <li class="active" data-page="0">Server  x20</li>
          <li data-page="1">Server Miracle x50</li>
        </ul> -->
								<div>
									<div style="display: block;">
										<!--
      <form class="search-form" method="post" action="post/search">
        <div class="search">
          <input type="hidden" name="type" value="8">
          <input type="hidden" name="where" value="">
          <input class="search-box" name="search" type="search" placeholder="Search on a server  x20">
          <select name="action">
            <option value="character">Character</option>
            <option value="guild">Guild</option>
          </select>
          <input class="nice-button" type="submit" value="Find">
          <div class="search-result"></div>
        </div>
      </form>							<a class="nice-button" href="ratings/users/">Top characters</a>
										<a class="nice-button" href="ratings/guilds/">Top guilds</a>
										<a class="nice-button" href="ratings/gens/">Top gens</a>
										<a class="nice-button" href="ratings/events/">Top events</a>
										<a class="nice-button" href="ratings/vote/">Top voters</a>
										<a class="nice-button" href="ratings/prison/">Prison</a>-->


{#RANKINGS}
										<div class="spacer3"></div>



										<h4>{#RAKING-NAME}</h4>
										<div class="spacer3"></div>

										<p>Only active players, who were online in last 30 days, appears in the Top.<br><img src="images/premium/top_gold.png" alt=""> - VIP Gold status, more opportunities, higher rates and other, more information at <a href="vip">VIP</a> section.</p>
<!--
										<div class="spacer2"></div>

										<div class="center">
											<a href="ratings/users/" class="mirror non">all</a>
											<a href="ratings/users/dw/" class="mirror non active">DW/SM/GM/SW</a>
											<a href="ratings/users/dk/" class="mirror non">DK/BK/BM/DK2</a>
											<a href="ratings/users/fe/" class="mirror non">FE/ME/HE/NE</a>
											<a href="ratings/users/mg/" class="mirror non">MG/DM/MK</a>
											<a href="ratings/users/dl/" class="mirror non">DL/LE/EL</a>
											<a href="ratings/users/su/" class="mirror non">SU/BS/DM/DS</a>
											<a href="ratings/users/rf/" class="mirror non">RF/FM/FB</a>
											<a href="ratings/users/gl/" class="mirror non">GL/ML/SL</a>
										</div>
-->
										<div class="spacer3"></div>
<!--
										<table class="topics">
											<tbody>
												<tr>
													<th class="st6">#</th>
													<th>Character</th>
													<th class="center">VIP</th>
													<th class="center">Class</th>
													<th class="st5">Level</th>
													<th class="st4">Master Level</th>
													<th class="st11">Achievement</th>
													<th class="st6">Gens</th>
													<th class="st6"></th>
												</tr>

												<tr>
													<td class="st6">
														<div class="rank1">1</div>
													</td>
													<td><a href="char/Eleeri/"><b>Eleeri</b></a>
													</td>
													<td class="center"><img src="images/premium/top_gold.png" alt="">
													</td>
													<td class="center">Grand Master</td>
													<td class="st5">400</td>
													<td class="st5">199</td>
													<td class="st11">
														<ul class="achiev-star" style="width:16px">
															<li class="achiev-rating" style="width:0px"></li>
														</ul>
													</td>
													<td class="st6"><img class="help_text" src="images/gens/small/v14.png" title="Vanert - Private" alt="">
													</td>
													<td class="st6"><i class="dot-online"></i>
													</td>
												</tr>
												<tr class="rowclass">
													<td class="st6">
														<div class="rank2">2</div>
													</td>
													<td><a href="char/Orion/"><b>Orion</b></a>
													</td>
													<td class="center"><img src="images/premium/top_gold.png" alt="">
													</td>
													<td class="center">Grand Master</td>
													<td class="st5">400</td>
													<td class="st5">199</td>
													<td class="st11">
														-
													</td>
													<td class="st6"><img class="help_text" src="images/gens/small/v14.png" title="Vanert - Private" alt="">
													</td>
													<td class="st6"><i class="dot-online"></i>
													</td>
												</tr>
												<tr>
													<td class="st6">
														<div class="rank3">3</div>
													</td>
													<td><a href="char/MrOwn3D/"><b>MrOwn3D</b></a>
													</td>
													<td class="center"><img src="images/premium/top_gold.png" alt="">
													</td>
													<td class="center">Grand Master</td>
													<td class="st5">400</td>
													<td class="st5">199</td>
													<td class="st11">
														-
													</td>
													<td class="st6"><img class="help_text" src="images/gens/small/v14.png" title="Vanert - Private" alt="">
													</td>
													<td class="st6"><i class="dot-online"></i>
													</td>
												</tr>
												<tr class="rowclass">
													<td class="st6">4</td>
													<td><a href="char/ProSM/"><b>ProSM</b></a>
													</td>
													<td class="center"> - </td>
													<td class="center">Grand Master</td>
													<td class="st5">400</td>
													<td class="st5">122</td>
													<td class="st11">
														-
													</td>
													<td class="st6"><img class="help_text" src="images/gens/small/v14.png" title="Vanert - Private" alt="">
													</td>
													<td class="st6"><i class="dot-offline"></i>
													</td>
												</tr>
												<tr>
													<td class="st6">5</td>
													<td><a href="char/Trifonov/"><b>Trifonov</b></a>
													</td>
													<td class="center"> - </td>
													<td class="center">Grand Master</td>
													<td class="st5">400</td>
													<td class="st5">118</td>
													<td class="st11">
														-
													</td>
													<td class="st6"><img class="help_text" src="images/gens/small/d14.png" title="Duprian - Private" alt="">
													</td>
													<td class="st6"><i class="dot-online"></i>
													</td>
												</tr>
												<tr class="rowclass">
													<td class="st6">6</td>
													<td><a href="char/Rogue/"><b>Rogue</b></a>
													</td>
													<td class="center"> - </td>
													<td class="center">Grand Master</td>
													<td class="st5">400</td>
													<td class="st5">85</td>
													<td class="st11">
														-
													</td>
													<td class="st6"><img class="help_text" src="images/gens/small/d14.png" title="Duprian - Private" alt="">
													</td>
													<td class="st6"><i class="dot-online"></i>
													</td>
												</tr>
												<tr>
													<td class="st6">7</td>
													<td><a href="char/Voyager/"><b>Voyager</b></a>
													</td>
													<td class="center"> - </td>
													<td class="center">Grand Master</td>
													<td class="st5">400</td>
													<td class="st5">85</td>
													<td class="st11">
														-
													</td>
													<td class="st6"><img class="help_text" src="images/gens/small/d14.png" title="Duprian - Private" alt="">
													</td>
													<td class="st6"><i class="dot-online"></i>
													</td>
												</tr>
												<tr class="rowclass">
													<td class="st6">8</td>
													<td><a href="char/Dead/"><b>Dead</b></a>
													</td>
													<td class="center"> - </td>
													<td class="center">Grand Master</td>
													<td class="st5">400</td>
													<td class="st5">48</td>
													<td class="st11">
														-
													</td>
													<td class="st6"><img class="help_text" src="images/gens/small/d14.png" title="Duprian - Private" alt="">
													</td>
													<td class="st6"><i class="dot-offline"></i>
													</td>
												</tr>
												<tr>
													<td class="st6">9</td>
													<td><a href="char/TrueWizard/"><b>TrueWizard</b></a>
													</td>
													<td class="center"> - </td>
													<td class="center">Grand Master</td>
													<td class="st5">400</td>
													<td class="st5">39</td>
													<td class="st11">
														-
													</td>
													<td class="st6"><img class="help_text" src="images/gens/small/d14.png" title="Duprian - Private" alt="">
													</td>
													<td class="st6"><i class="dot-online"></i>
													</td>
												</tr>
												<tr class="rowclass">
													<td class="st6">10</td>
													<td><a href="char/oMrRed/"><b>oMrRed</b></a>
													</td>
													<td class="center"> - </td>
													<td class="center">Grand Master</td>
													<td class="st5">400</td>
													<td class="st5">13</td>
													<td class="st11">
														-
													</td>
													<td class="st6"><img class="help_text" src="images/gens/small/v14.png" title="Vanert - Private" alt="">
													</td>
													<td class="st6"><i class="dot-offline"></i>
													</td>
												</tr>

											</tbody>
										</table>
-->
{#ResultRankings}



									</div>
									<!--
									<div style="display: none;">
										<form class="search-form" method="post" action="post/search">
											<div class="search">
												<input type="hidden" name="type" value="8">
												<input type="hidden" name="where" value="miracle">
												<input class="search-box" name="search" type="search" placeholder="Search on a server Miracle x50">
												<select name="action">
													<option value="character">Character</option>
													<option value="guild">Guild</option>
												</select>
												<input class="nice-button" type="submit" value="Find">
												<div class="search-result"></div>
											</div>
										</form>

										<a class="nice-button" href="ratings/users/miracle">Top characters</a>
										<a class="nice-button" href="ratings/guilds/miracle">Top guilds</a>
										<a class="nice-button" href="ratings/gens/miracle">Top gens</a>
										<a class="nice-button" href="ratings/events/miracle">Top events</a>
										<a class="nice-button" href="ratings/vote/miracle">Top voters</a>
										<a class="nice-button" href="ratings/prison/miracle">Prison</a>

										<div class="spacer3"></div>


									</div>
-->
								</div>
							</div>

						</div>








					</div>
				</div>
				<div class="clear"></div>
			</div>

		</div>

		{#INCLUDE:footer}
	</body>
	</html>