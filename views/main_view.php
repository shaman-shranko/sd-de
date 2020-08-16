<?php
$by = [['value'=>'pubDate', 'name'=>'Date'],['value'=>'title', 'name'=>'Name']];
$direction = [['value'=>'desc', 'name'=>'Newer'],['value'=>'asc', 'name'=>'Older']];
 if (!empty($news)): ?>
    <form action="/" method="post">
        <select name="order[by]">
            <? foreach ($by as $item): ?>
            <option value="<?= $item['value'] ?>" <?= isset($_SESSION['order']) && $_SESSION['order']['by']==$item['value'] ?"selected":"" ?>><?= $item['name'] ?></option>
            <? endforeach; ?>
        </select>
        <select name="order[direction]">
          <? foreach ($direction as $item): ?>
              <option value="<?= $item['value'] ?>" <?= isset($_SESSION['order']) && $_SESSION['order']['by']==$item['value'] ?"selected":"" ?>><?= $item['name'] ?></option>
          <? endforeach;; ?>
        </select>
        <button type="submit">Submit</button>
    </form>
    <table>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Published</th>
            <th>Link</th>
        </tr>
      <?php foreach ($news as $item): ?>
          <tr>
              <td><img src="<?= $item['image'] ?>"/></td>
              <td><?= $item['title'] ?></td>
              <td><?= $item['description'] ?></td>
              <td><?= $item['pubDate'] ?></td>
              <td>
                  <a href="<?= $item['link'] ?>">
                <?= $item['link'] ?>
                  </a>
              </td>
          </tr>
      <?php endforeach; ?>
    </table>
     <div style="justify-content: center; ">
         <ul style="display:flex;list-style: none;justify-content: center;">
           <?php for ($i = 0; $i < $pages; $i++): ?>
               <li style="display:inline; padding: 5px"><a href="/?page=<?= $i+1 ?>"><?= $i+1 ?></a></li>
           <?php endfor; ?>
         </ul>
     </div>
<?php else: ?>
    No data
<?php endif; ?>

