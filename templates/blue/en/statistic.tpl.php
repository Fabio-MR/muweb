{#INCLUDE:header}
	<body>
		{#DIV[LOGIN_LOGOUT]}
		<div id="container">

			<div class="wrapper">
				{#INCLUDE:sidebar}
				<div id="content">

					<div class="article">
						<!--
                        <div id="warn-info">With our unique <a href="https://norebirth.com/topic/927-rampage-x20-progressive-content/">progressive system</a> it's never too late to join the Rampage server!</div>
-->
						<h2><i class="icons icon-statistic"></i>Statistics</h2>
						<div class="spacer3"></div>


						<table class="topics">
							<tbody>
								<tr>


									<th>Server statistics</th>
									<th class="st10">{#SERVERNAME}</th>
								</tr>
								<tr class="rowclass">
									<td>Server status</td>
									<td class="st10"><i class="dot-online"></i> {#VERSION}</td>
								</tr>
								<tr>
									<td>Online</td>
									<td class="st10">{#TOTAL_ONLINE}</td>
								</tr>
								<tr class="rowclass">
									<td>Active players 24h</td>
									<td class="st10">{#ACTIVEDAY}</td>
								</tr>
								<tr>
									<td>Game Masters</td>
									<td class="st10">{#TOTALGAMEMASTER}</td>
								</tr>
								<tr class="rowclass">
									<td>Accounts</td>
									<td class="st10">{#TOTALACCOUNTS}</td>
								</tr>
								<tr>
									<td>Guilds</td>
									<td class="st10">{#TOTALGUILDS}</td>
								</tr>
								<tr class="rowclass">
									<td>Version</td>
									<td class="st10">{#SERVERVERSION}</td>
								</tr>
								<tr>
									<td>Experience</td>
									<td class="st10">{#EXPERIENCE}</td>
								</tr>
								<tr class="rowclass">


								</tr>
							</tbody>
						</table>
						<div class="spacer3"></div>
						<!--

<table class="topics">
          
      <tbody><tr><th>Market statistics</th>
              <th class="st10">{#SERVERNAME}</th>
            </tr>
    <tr>
          <td>Active lots</td>
              <td class="st10">{#ACTIVELOTS}</td>
            </tr>
    <tr class="rowclass">
          <td>Expired lots</td>
              <td class="st10">{#EXPUIREDLOTS}</td>
            </tr>
    <tr>
          <td>Total items</td>
              <td class="st10">{#TOTALITENS}</td>
            </tr>
    <tr class="rowclass">
          <td>Amount of sold items in W Coins</td>
              <td class="st10">{#AMOUNTSOUD}</td>
            </tr>
    <tr>
        
       
        </tr></tbody></table>
			
				  <div class="spacer3"></div>-->

						<div class="spacer3"></div>

						<table class="topics">

							<tbody>
								<tr>
									<th>Crywolf</th>
									<th class="st10">{#SERVERNAME}</th>
								</tr>
								<tr>
									<td>Fortress status</td>
									<td class="st10">{#CRYWOLFSTATUS}</td>
								</tr>
								<tr class="rowclass">
									<td>Attack time</td>
									<td class="st10">{#CRYWOLFATTACK}</td>
								</tr>
								<tr>


								</tr>
							</tbody>
						</table>

						<div class="spacer3"></div>
						<table class="topics">

							<tbody>
								<tr>
									<th>Castle Siege</th>
									<th class="st10">{#SERVERNAME}</th>
								</tr>
								<tr class="rowclass">
									<td>Castle owner</td>
									<td class="st10"><a href="guild/Admins/rampage">{#WONERCS}</a>
									</td>
								</tr>
								<tr>
									<td>Attack time</td>
									<td class="st10">{#CSATTACK}</td>
								</tr>
								<tr class="rowclass">
									<td>Siege participants</td>
									<td class="st10">{#CSPARTICIPANTS}</td>
								</tr>
								<tr>


								</tr>
							</tbody>
						</table>

						<div class="spacer3"></div>





					</div>
				</div>
				<div class="clear"></div>
			</div>

		</div>

		{#INCLUDE:footer}
	</body>
	</html>