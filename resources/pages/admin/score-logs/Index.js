import React from "react";
import {PageHeader} from "react-bootstrap";
import app from 'app';
import SearchDateRangePicker from "components/SearchDateRangePicker";
import TableProvider from "components/TableProvider";
import Table from "components/Table";
import SearchItem from "components/SearchItem";
import SearchForm from "components/SearchForm";
import UserPopoverV1 from "vendor/miaoxing/user/resources/components/UserPopoverV1";
import Options from "components/Options";

const ACTION_ADD = 1;

export default class extends React.Component {
  state = {
    enableShop: false,
    sources: [],
    actions: [],
  };

  componentDidMount() {
    $.ajax({
      url: app.actionUrl('metadata.json'),
      loading: true,
    }).done(ret => {
      if (ret.code !== 1) {
        return $.msg(ret);
      }

      this.setState(ret);
    });
  }

  render() {
    return <React.Fragment>
      <PageHeader>
        {wei.page.controllerTitle}
      </PageHeader>

      <TableProvider>
        <SearchForm>
          <SearchItem label="昵称" name="user[nickName$ct]"/>
          <SearchItem label="手机" name="user[mobile$ct]"/>
          <SearchItem label="会员卡号" name="cardCode$ct"/>
          <SearchItem label="来源" name="source">
            <Options data={this.state.sources}/>
          </SearchItem>
          <SearchItem label="变化类型" name="action$eq">
            <Options data={this.state.actions} labelKey="text" valueKey="id"/>
          </SearchItem>
          <SearchItem label="变化说明" name="description$ct"/>
          <SearchDateRangePicker label="变化时间" name="createdAt" min="$ge" max="$le"/>
        </SearchForm>

        <Table
          columns={[
            {
              text: '用户',
              dataField: 'user',
              formatter: cell => <UserPopoverV1 data={cell}/>
            },
            {
              text: '卡号',
              dataField: 'cardCode',
            },
            {
              text: '门店编号',
              dataField: 'shopId',
              hidden: !this.state.enableShop
            },
            {
              text: '来源',
              dataField: 'source'
            },
            {
              text: '积分变化',
              dataField: 'score',
              formatter: (cell, row) => row.action === ACTION_ADD ? ('+' + cell) : ('-' + cell),
            },
            {
              text: '变化说明',
              dataField: 'description'
            },
            {
              text: '变化时间',
              dataField: 'createdAt'
            },
          ]}
        />
      </TableProvider>
    </React.Fragment>;
  }
}
