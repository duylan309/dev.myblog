<thead>
  <tr>
    <th>
    	<div class="th-inner">
    		<label>
				<input id="check_all" type="checkbox" />
			</label>
		</div>
	</th>
    <th><?=$language->UPDATE;?></th>
    <th><div class="sortTable" table="<?=$lang=="en" ? "title_en" : "title_vn"?>" ><?=$language->TITLE;?></div></th>
    <th><?=$language->Image;?></th>
    <th><div class="sortTable" table="date"><?=$language->DATE;?></div></th>
    <th><div class="sortTable" table="sort"><?=$language->SORT;?></div></th>
    <th><?=$language->STATUS?></th>
  </tr>
</thead>